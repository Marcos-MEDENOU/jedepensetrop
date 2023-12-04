<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3"
import {
  mdiAccountKey,
  mdiArrowLeftBoldOutline,
} from "@mdi/js"
import LayoutAuthenticated from "@/Layouts/AuthenticatedLayout.vue"
import SectionMain from "@/Components/SectionMain.vue"
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue"
import CardBox from "@/Components/CardBox.vue"
import BaseButton from "@/Components/BaseButton.vue"

const props = defineProps({
  posts: {
    type: Object,
    default: () => ({}),
  },
  roles: {
    type: Object,
    default: () => ({}),
  },
  userHasRoles: {
    type: Object,
    default: () => ({}),
  }
})


function setimgSrc(htmlContent) {
  //créer une div temporaire sans l'ajouter dans le dom
  let tempElement = document.createElement("div");
  //ajoute le code htmml a l'intérieur de la div
  tempElement.innerHTML = htmlContent;
  //Expression réguliere qui détecte les attributs src a modifier
  let regex = /^https:\/\/jedepensetrop\/admin/;
  //Vérification et execution d'un bloc de code pour chacune des attributs src des images
  tempElement.querySelectorAll("img").forEach(function (imgTag) {
    //Cas ou une image verifiant la regex a été détectée
    if (regex.test(imgTag.src)) {
      //Coupure de l'attribut src a partir de /
      let x = imgTag.src.split("/");
      //supression de 2em element du tableau obtenu
      x.splice(1, 1);
      //supression du 1er element du nouveau tableau apres la ligne de split précédente
      x.splice(0, 1);
      //Supresion det remplacement du 1er element du nouveau tableau par l'adresse localhost du serveur
      // x.splice(0, 1, "http://interstis.com/backend/public");
      x.splice(0, 2, "https://jedepensetrop.fr/");
      //Association des elements tableau avec pour indice '/'
      let y = x.join("/");
      //Remplacement du src du code html actuelle par le nouveau
      imgTag.src = y;
    }
  });
  // Obtenez le contenu HTML modifié
  let modifiedHtmlContent = tempElement;
  return modifiedHtmlContent.innerHTML;
}

</script>

<template>
  <LayoutAuthenticated>

    <Head title="Donnée peronnelle de l'utilisateur" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiTrashCan" title="Prévisualiser le contenu" main>
        <BaseButton :route-name="route('author.index')" :icon="mdiArrowLeftBoldOutline" label="Back" color="white"
          rounded-full small />
      </SectionTitleLineWithButton>
      <CardBox class="mb-6">
        <!-- <table>
          <tbody>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
                Nom de l'auteur
              </td>
              <td data-label="Name">
                {{ authors.name }}
              </td>
            </tr>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
               Bio auteur
              </td>
              <td data-label="description">
                {{ authors.bio }}
              </td>
            </tr>
            <tr>
              <td
                class="hidden p-4 pl-8 text-slate-500 dark:text-slate-400 lg:block"
              >
               email
              </td>
              <td data-label="visibility">
                {{ authors.email }}
              </td>
            </tr>
          
          </tbody>
        </table> -->

        <div id="editor" v-html="setimgSrc(posts.content)"></div>

      </CardBox>
    </SectionMain>
  </LayoutAuthenticated>
</template>

<style>
#editor h1 {
  font-weight: bold;
  margin-block: 1rem;
  font-size: 32pt;
  line-height: 3.5rem;
  /* font-family: DMSans; */
}

#editor h2 {
  font-weight: bold;
  margin-block: 1rem;
  font-size: 24pt;
}

#editor h3 {
  text-decoration: underline;
  font-size: 18pt;
}

#editor p,
#editor ul,
#editor table {
  font-size: 12pt;
  /* font-family: DMSans; */
  padding-block: 5pt;
}

#editor table.full {
  display: block;
  background-color: white;
}

#editor h3 {
  text-decoration: underline
}

#editor ul li{
  list-style: disc;
  margin-left: 2.5rem;
}

#editor ol li{
  list-style: decimal;
  margin-left: 2.5rem;
}


</style>