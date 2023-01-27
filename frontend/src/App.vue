<script setup>
import { RouterView } from "vue-router";
import TestCom from "./components/TestCom.vue";
import NavBar from "./components/NavBar.vue";
</script>

<template>
  <NavBar />
  <RouterView />
  <TestCom msg="You did it!" />
</template>

<style></style>
