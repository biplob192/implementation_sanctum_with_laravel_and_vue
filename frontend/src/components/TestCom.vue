<script>
export default {
  props: {
    msg: String,
    likes: Number,
  },

  data() {
    return {
      data: this.$store.state.data,
      user: this.$store.state.user,
      books: this.$store.state.books,
    };
  },
  computed: {
    studentCount() {
      return this.$store.getters.countStudents;
    },
  },
};
</script>

<template>
  <div>
    <h3>
      You've successfully created a project with
      <span style="color: orangered">{{ msg }}</span>
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
