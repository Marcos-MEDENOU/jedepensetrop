<template>
  <editor v-model="editorValue" :init="init"></editor>
</template>

<script setup>
import { reactive, ref, watch, toRefs } from 'vue';

import tinymce from 'tinymce/tinymce.js';
import 'tinymce/models/dom';
import 'tinymce/skins/ui/oxide/skin.css';
import 'tinymce/themes/silver';

// Icon
import 'tinymce/icons/default';
import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/listss';
import 'tinymce/plugins/emoticons/js/emojis.js';
import 'tinymce/plugins/table';
import 'tinymce/plugins/quickbars';
import 'tinymce/plugins/image';
// import 'tinymce-i18n/langs5/fr_FR.js';
import Editor from '@tinymce/tinymce-vue';

const props = defineProps({
  modelValue: {
    type: String,
    default: '',
  },
  plugins: {
    type: [String, Array],
    default: 'quickbars emoticons table lists autoresize link image media code',
  },
  toolbar: {
    type: [String, Array],
    default:
      'fontfamily fontsize hr lineheight| indent outdent | removeformat bold code italic underline strikethrough image |fontsizeselect blocks fonts | numlist bullist table | forecolor backcolor | alignleft aligncenter alignright alignjustify | blockquote | undo redo | axupimgs  | emoticons',
  },
});

const emit = defineEmits(['update:modelValue']);

const init = reactive({
  language: 'fr_FR',
  document_base_url: '/public/',
  height: 800,
  width: '50% !important',
  resize: 'both',
  // content_css: '/css/tailwind.css',
  // menubar:false,
  menubar: 'file format tools ',
  images_upload_url: '/editorUpload',
  autosave_restore_when_empty: true,
  // spellchecker_active: true,
  automatic_uploads: true,
  content_style: 'body{font-family: DMSans}' +
    'h1{font-weight: bold; margin-block:2rem;font-size :28pt;font-family: DMSans;}' +
    'h2{font-weight: bold; margin-block:1rem;font-size :24pt; }' +
    'h3{ text-decoration: underline ; font-size:18pt; }' +
    'p,ul,table {font-size:14pt; font-family: DMSans; }' +
    'table.full { display: block; background-color:white; } ' +
    'h3{text-decoration: underline}',
  plugins: props.plugins,
  toolbar: props.toolbar,
  // toolbar_sticky_offset: 64,
  // toolbar_mode: 'sliding',
  // quickbars_insert_toolbar: false,
  branding: false,
  // toolbar_sticky: true,
  promotion: false,
  skin: (window.matchMedia("(prefers-color-scheme: dark)").matches ? "oxide-dark" : ""),
  content_css: (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : ""),

  file_picker_types: 'image',
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);
        cb(blobInfo.blobUri(), { title: file.name });
      };
    };
    input.click();
  }

});

const { modelValue } = toRefs(props);
const editorValue = ref(modelValue.value);

watch(modelValue, (newValue) => {
  editorValue.value = newValue;
});

watch(editorValue, (newValue) => {
  emit('update:modelValue', newValue);
});
</script>
