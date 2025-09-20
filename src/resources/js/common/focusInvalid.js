export function initFocusInvalid() {
    // エラーがある場合、最初のエラー項目へフォーカス
    const firstInvalid = document.querySelector('[aria-invalid="true"]');
    if (firstInvalid) firstInvalid.focus({ preventScroll: false });
}
