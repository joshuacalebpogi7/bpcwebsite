// Import third-party libraries and stylesheets
import './bootstrap';
import 'tinymce/tinymce';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/content/default/content.min.css';
import 'tinymce/skins/content/default/content.css';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';

// Import your custom CSS files
// import '../css/app.css';
// import '../css/appadmin.css';
// import '../css/job.css';
// import '../css/login.css';
// import '../css/style.css';
// import '../css/styles.css';

// Import your custom JavaScript modules
// import { Design } from './design';
// // import Job from './job';
// // import Main from './main';

// // Check for specific elements with CSS classes and instantiate corresponding classes
// if (document.querySelector("#menu-btn")) {
//     new Design();
// }

// if (document.querySelector(".menu-bar")) {
//     new Job();
// }

// if (document.querySelector(".main-pd")) {
//     new Main();
// }

// Initialize TinyMCE
var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
tinymce.init({
    selector: 'textarea', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'searchreplace fullscreen link pagebreak nonbreaking advlist lists wordcount emoticons',
    menubar: '',
    toolbar: 'undo redo | bold italic underline strikethrough | superscript subscript | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | emoticons | fullscreen save print',
    toolbar_sticky: true,
    branding: false,
    promotion: false,
});
