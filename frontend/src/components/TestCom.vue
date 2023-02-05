<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  props: {
    msg: String,
    likes: Number,
  },

  data() {
    return {
      // books: this.$store.state.books,
    };
  },
  computed: {
    studentCount() {
      return this.$store.getters.countStudents;
    },

    // First method
    // ...mapState("sample", {
    //     data: (state) => state.data,
    //   }),

    // Second method
    // ...mapState(['user']),
    ...mapState({
      user: 'user',
      books: 'books',
      data: state => state.sample.data,
    }),
  },
};
</script>

<template>
  <div>
    <h3>
      You've successfully created a project with <span style="color: orangered">{{ msg }}</span>
    </h3>
    <b>{{ data }}</b> from Test components.

    <p>User Info:</p>
    {{ user.name }} <br />
    Mobile: {{ user.mobile }}<br />
    Address: {{ user.address }}<br />

    <p>Book Info:</p>
    <li v-for="book in books">{{ book.name }}, [Author: {{ book.author }}]</li>

    <p>Total Number of Students: {{ studentCount }}</p>
  </div>
</template>

<style scoped></style>
