<?php ($platform = $platform ?? 'other'); ?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
  <?php switch($platform):
    case ('facebook'): ?>
      <path fill="currentColor" stroke="none" d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0 0 22 12z"/>
      <?php break; ?>
    <?php case ('instagram'): ?>
      <rect x="2.5" y="2.5" width="19" height="19" rx="5"/>
      <circle cx="12" cy="12" r="4.2"/>
      <circle cx="17.4" cy="6.6" r="0.9" fill="currentColor" stroke="none"/>
      <?php break; ?>
    <?php case ('x'): ?>
      <path fill="currentColor" stroke="none" d="M18.9 2H22l-7.1 8.1L23.2 22h-6.6l-5.2-6.8L5.5 22H2.4l7.6-8.7L1.8 2h6.8l4.7 6.2L18.9 2zm-1.1 18h1.8L7.2 3.9H5.3L17.8 20z"/>
      <?php break; ?>
    <?php case ('youtube'): ?>
      <rect x="2" y="5" width="20" height="14" rx="4"/>
      <path fill="currentColor" stroke="none" d="M10 9l6 3-6 3z"/>
      <?php break; ?>
    <?php case ('tiktok'): ?>
      <path fill="currentColor" stroke="none" d="M16.6 5.82A6.2 6.2 0 0 0 15.54 2h-3.1v13.2a3.7 3.7 0 1 1-3.7-3.7c.34 0 .67.05.98.14V8.47a6.8 6.8 0 1 0 5.82 6.73V8.7a9.3 9.3 0 0 0 5.46 1.74V7.3a6.2 6.2 0 0 1-4.4-1.48z"/>
      <?php break; ?>
    <?php case ('whatsapp'): ?>
      <path d="M20.5 3.5A10.3 10.3 0 0 0 3.7 16.1L2 22l6-1.6A10.3 10.3 0 1 0 20.5 3.5z"/>
      <path d="M8.4 7.6c.2-.4.4-.4.7-.4h.6c.2 0 .4.1.6.5l.8 1.9c.1.2.1.4 0 .6l-.5.6c-.1.2-.2.3-.1.5.4.8 1.4 1.8 2.5 2.2.2.1.4.1.5-.1l.6-.7c.2-.2.4-.2.6-.1l1.9.9c.3.1.4.3.4.5v.6c0 .4-.2.9-.7 1.2-.5.4-1.3.5-2.1.3-1.1-.3-2.8-1.1-4.3-2.6-1.5-1.5-2.3-3.2-2.6-4.3-.2-.8-.1-1.6.3-2.1z"/>
      <?php break; ?>
    <?php case ('telegram'): ?>
      <path d="M22 2L2 10.5l6.2 2.3L10 21l3.1-4.1 4.9 3.6L22 2z"/>
      <path d="M8.2 12.8l10.4-7.1-8.1 8.9"/>
      <?php break; ?>
    <?php case ('linkedin'): ?>
      <path fill="currentColor" stroke="none" d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3zM9 9h3.8v1.7h.1c.5-.9 1.7-1.9 3.5-1.9 3.7 0 4.4 2.4 4.4 5.6V21h-4v-5.6c0-1.3 0-3-1.9-3s-2.2 1.4-2.2 2.9V21H9z"/>
      <?php break; ?>
    <?php case ('snapchat'): ?>
      <path d="M12 2c-2.8 0-4.5 2-4.5 4.5 0 1 .1 2 .1 2.8-.6.3-1.3.2-1.9-.1-.8-.4-1.6.4-1.2 1.2.5.9 1.7 1.4 2.1 1.9.4.5-.1 1.3-1.2 1.8-.9.5-.4 1.8.6 2 1.4.3 2.5.8 3.3 1.7.7.8 1.6 1.2 2.7 1.2s2-.4 2.7-1.2c.8-.9 1.9-1.4 3.3-1.7 1-.2 1.5-1.5.6-2-1.1-.5-1.6-1.3-1.2-1.8.4-.5 1.6-1 2.1-1.9.4-.8-.4-1.6-1.2-1.2-.6.3-1.3.4-1.9.1.1-.8.1-1.8.1-2.8C16.5 4 14.8 2 12 2z"/>
      <?php break; ?>
    <?php case ('website'): ?>
      <circle cx="12" cy="12" r="9"/>
      <path d="M3 12h18M12 3c2.4 2.5 3.6 5.5 3.6 9S14.4 18.5 12 21c-2.4-2.5-3.6-5.5-3.6-9S9.6 5.5 12 3z"/>
      <?php break; ?>
    <?php default: ?>
      <path d="M10.5 13.5l3-3"/>
      <path d="M7.8 16.2l-1.1 1.1a3.8 3.8 0 0 1-5.4-5.4l2.5-2.5a3.8 3.8 0 0 1 5.4 0"/>
      <path d="M16.2 7.8l1.1-1.1a3.8 3.8 0 0 1 5.4 5.4l-2.5 2.5a3.8 3.8 0 0 1-5.4 0"/>
      <?php break; ?>
  <?php endswitch; ?>
</svg>
<?php /**PATH D:\syrian-real-estate\resources\views\partials\social-icon.blade.php ENDPATH**/ ?>