export function initAntiMultiSubmit() {
    const forms = document.querySelectorAll('.js-submit-form');
    forms.forEach(form => {
        const submitBtn = form.querySelector('.js-submit-btn');
        if (!submitBtn) return;

        form.addEventListener('submit', (e) => {
            submitBtn.disabled = true;
            submitBtn.setAttribute('aria-busy', 'true');
            submitBtn.textContent = submitBtn.dataset.submittingLabel || '送信中...';
        });

        // bfcache 対応
        window.addEventListener('pageshow', (e) => {
            if (e.persisted) {
                submitBtn.disabled = false;
                submitBtn.removeAttribute('aria-busy');
                submitBtn.textContent = submitBtn.dataset.label || '送信';
                // 同期関数がグローバルにあれば呼ぶ
                if (typeof window.syncPasswordToggleButtons === 'function') {
                    window.syncPasswordToggleButtons();
                }
            }
        });
    });
}
