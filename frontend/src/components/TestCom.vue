<script>
export default {
  props: {
    msg: String,
    likes: Number
  },
  
  data() {
    return{
    data: this.$store.state.data,
  }
  }
 }
</script>

<template>
  <div>
    <h3>You’ve successfully created a project with <span style="color: orangered;">{{ msg }}</span> </h3>
    <b>{{ data }}</b> from HelloWorld components.
  </div>
</template>

<style scoped></style>
