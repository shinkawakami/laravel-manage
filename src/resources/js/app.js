import './bootstrap';
import { initAntiMultiSubmit } from './common/antiMultiSubmit';
import { initPasswordToggle } from './common/passwordToggle';
import { initFocusInvalid } from './common/focusInvalid';

document.addEventListener('DOMContentLoaded', () => {
  initAntiMultiSubmit();
  initPasswordToggle();
  initFocusInvalid();
});
