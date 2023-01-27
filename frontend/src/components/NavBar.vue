<script>
import { RouterLink } from "vue-router";

export default {
     methods: {
          logout() {
               console.log('Logout Clicked!!');
          }
     }
     
}
</script>
<template>
  <div>
    <nav>
      <RouterLink to="/">Home</RouterLink>
      <RouterLink to="/about">About</RouterLink>
      <a href="#" @click="logout">Logout</a>
    </nav>
    <hr>
  </div>
</template>
<style scoped>
nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: #fff;
  background-color: orangered;
  border-radius: 5px;
}
a:hover {
  color: orangered;
  text-decoration: underline;
}
nav a.router-link-exact-active:hover {
  text-decoration: none;
}

nav a {
  display: inline-block;
  font-size: 21px;
  text-decoration: none;
  padding: 5px;
  margin: 5px;
  border-left: 1px solid var(--color-border);
}

.main {
  width: 80%;
  margin: auto;
}
</style>
