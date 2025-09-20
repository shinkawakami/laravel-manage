export function initPasswordToggle() {
    // パスワード表示/非表示
    const toggles = document.querySelectorAll('.js-password-toggle');
    toggles.forEach((btn) => {
        btn.addEventListener('click', () => {
            togglePassword(btn);
        });

        // Enter/Spaceでの操作もOKに
        btn.addEventListener('keydown', (e) => {
            if (e.key === ' ' || e.key === 'Enter') {
                e.preventDefault();
                togglePassword(btn);
            }
        });
    });

    function togglePassword(btn) {
        const targetId = btn.getAttribute('data-target');
        const input = document.getElementById(targetId);
        if (!input) return;

        const show = input.type === 'password';
        input.type = show ? 'text' : 'password';

        // アクセシビリティ属性を更新
        btn.setAttribute('aria-pressed', String(show));
        btn.setAttribute('aria-label', show ? 'パスワードを非表示' : 'パスワードを表示');

        // 視覚アイコン更新
        btn.textContent = show ? '🙈' : '👁';
    }
}
