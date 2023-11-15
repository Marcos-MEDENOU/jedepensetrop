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
    default: 'quickbars emoticons table image',
  },
  toolbar: {
    type: [String, Array],
    default:
      ' bold italic underline strikethrough | image |fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify|bullist numlist |outdent indent blockquote | undo redo | axupimgs | removeformat | table | emoticons',
  },
});

const emit = defineEmits(['update:modelValue']);

const init = reactive({
  language: 'fr_FR',
  height: 600,
  width: '100% !important',
  resize: 'both',
  menubar: 'file edit insert view format table tools help',
  images_upload_url: '/editorUpload',
  automatic_uploads: true,
  // skin: "oxide-dark",
  // content_css: "dark",
  plugins: props.plugins,
  toolbar: props.toolbar,
  quickbars_insert_toolbar: false,
  branding: false,
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
