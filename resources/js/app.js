// Import third-party libraries and stylesheets
import './bootstrap';
import 'tinymce/tinymce';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/content/default/content.min.css';
import 'tinymce/skins/content/default/content.css';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';

// Initialize TinyMCE
var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
tinymce.init({
    selector: 'textarea', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'searchreplace fullscreen link pagebreak nonbreaking advlist lists wordcount emoticons',
    menubar: '',
    toolbar: '',
    toolbar_sticky: true,
    branding: false,
    promotion: false,
});
