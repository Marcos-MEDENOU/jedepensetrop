<template>
  <div>
    <h2 class="text-2xl font-bold mb-4">Commentaires</h2>
    <ul>
      <li v-for="(comment, index) in comments" :key="index">
        <div class="mb-2">
          <p>{{ comment.text }}</p>
          <button @click="toggleReplyForm(index)" class="text-blue-500">
            {{ showReplyForm === index ? 'Annuler' : 'Répondre' }}
          </button>

          <div v-if="showReplyForm === index">
            <textarea v-model="replyText" class="mt-2"></textarea>
            <button @click="addReply(index)" class="bg-blue-500 text-white px-2 py-1 mt-2">
              Répondre
            </button>
          </div>

          <ul>
            <li v-for="(reply, replyIndex) in comment.replies" :key="replyIndex" class="ml-4">
              <p>{{ reply.text }}</p>
              <button @click="toggleReplyForm(index, replyIndex)" class="text-blue-500">
                {{ showReplyForm === `${index}-${replyIndex}` ? 'Annuler' : 'Répondre' }}
              </button>

              <div v-if="showReplyForm === `${index}-${replyIndex}`">
                <textarea v-model="replyText" class="mt-2"></textarea>
                <button @click="addReply(index, replyIndex)" class="bg-blue-500 text-white px-2 py-1 mt-2">
                  Répondre
                </button>
              </div>
            </li>
          </ul>
        </div>
      </li>
    </ul>

    <textarea v-model="newComment" class="mt-4"></textarea>
    <button @click="addComment" class="bg-blue-500 text-white px-2 py-1 mt-2">
      Ajouter un commentaire
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const comments = ref([
  { text: 'Premier commentaire', replies: [] },
  { text: 'Deuxième commentaire', replies: [] },
]);

let newComment = ref('');
let replyText = ref('');
let showReplyForm = ref(null);

const addComment = () => {
  if (newComment.trim() !== '') {
    comments.value.push({ text: newComment, replies: [] });
    newComment.value = '';
  }
};

const toggleReplyForm = (commentIndex, replyIndex = null) => {
  showReplyForm.value = showReplyForm.value === `${commentIndex}-${replyIndex}` ? null : `${commentIndex}-${replyIndex}`;
};

const addReply = (commentIndex, replyIndex = null) => {
  const comment = comments.value[commentIndex];
  if (replyIndex !== null) {
    comment.replies.push({ text: replyText });
  } else {
    comment.replies.push({ text: replyText, replies: [] });
  }
  replyText.value = '';
  toggleReplyForm(commentIndex, replyIndex);
};
</script>
