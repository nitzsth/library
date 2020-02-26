Vue.component('modal',{
  props: ['image'],
  },
  template: `
    <div class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-content">
    <p class="image is-4by3">
      <img src="@{{ book.avatar }}">
    </p>
  </div>
  <button class="modal-close is-large" aria-label="close" @click="$emit('close')"></button>
</div>
  `
});

new Vue({
  el: '#preview',

  data: {
    showModal: false,
    image: '$book->avatar',
  },

  computed: {
    image() {
      return this.image;
    }
  }
});
