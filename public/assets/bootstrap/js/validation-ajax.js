document.addEventListener("DOMContentLoaded", () => {
  // Find forms that should use AJAX validation; prefer explicit data attribute
  const forms = Array.from(document.querySelectorAll('form[data-validate-url], form[data-validate]'));
  if (forms.length === 0) return;

  function setStatus(box, type, msg) {
    if (!box) return;
    if (!msg) {
      box.className = "alert d-none";
      box.textContent = "";
      return;
    }
    box.className = `alert alert-${type}`;
    box.textContent = msg;
  }

  function findErrorElement(input) {
    // prefer next sibling with class text-danger
    let next = input.nextElementSibling;
    while (next) {
      if (next.classList && next.classList.contains('text-danger')) return next;
      next = next.nextElementSibling;
    }
    // fallback to id pattern
    const byId = document.getElementById(input.name + 'Error');
    if (byId) return byId;
    return null;
  }

  async function validateForm(form) {
    const fd = new FormData(form);
    let validateUrl = form.dataset.validateUrl || form.getAttribute('data-validate-url') || null;
    if (!validateUrl) {
      const action = form.getAttribute('action') || window.location.pathname;
      if (action.endsWith('/register')) validateUrl = action.replace(/\/register\/?$/, '/validate-register');
      else if (action.endsWith('/login')) validateUrl = action.replace(/\/login\/?$/, '/validate-login');
      else validateUrl = action.replace(/\/$/, '') + '/validate';
    }

    const res = await fetch(validateUrl, {
      method: 'POST',
      body: fd,
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    if (!res.ok) throw new Error('Erreur serveur lors de la validation.');
    return res.json();
  }

  function clearFeedback(form) {
    const inputs = form.querySelectorAll('[name]');
    inputs.forEach(input => {
      input.classList.remove('is-invalid', 'is-valid');
      const err = findErrorElement(input);
      if (err) err.textContent = '';
    });
    const statusBox = form.querySelector('#formStatus');
    setStatus(statusBox, null, '');
  }

  function applyServerResult(form, data) {
    // populate returned values
    if (data.values) {
      for (const [k, v] of Object.entries(data.values)) {
        const el = form.querySelector('[name="' + k + '"]');
        if (el && typeof v !== 'object') el.value = v;
      }
    }

    const inputs = form.querySelectorAll('[name]');
    inputs.forEach(input => {
      const name = input.getAttribute('name');
      const msg = (data.errors && data.errors[name]) ? data.errors[name] : '';
      const errEl = findErrorElement(input);
      if (msg) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        if (errEl) errEl.textContent = msg;
      } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        if (errEl) errEl.textContent = '';
      }
    });

    const statusBox = form.querySelector('#formStatus');
    if (data.errors && data.errors._global) setStatus(statusBox, 'warning', data.errors._global);
  }

  forms.forEach(form => {
    const statusBox = form.querySelector('#formStatus');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearFeedback(form);
      try {
        const data = await validateForm(form);
        applyServerResult(form, data);
        if (data.ok) {
          // submit the form normally after successful validation
          form.submit();
        } else {
          setStatus(statusBox, 'danger', 'Veuillez corriger les erreurs.');
        }
      } catch (err) {
        setStatus(statusBox, 'warning', err.message || 'Une erreur est survenue.');
        console.error(err);
      }
    });

    // blur validation per field
    form.querySelectorAll('[name]').forEach(input => {
      input.addEventListener('blur', async () => {
        try {
          const data = await validateForm(form);
          applyServerResult(form, data);
        } catch (_) {}
      });
    });
  });
});
