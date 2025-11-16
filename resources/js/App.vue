<template>
  <router-view v-slot="{ Component, route }">
    <div :key="route.name">
      <Component :is="Component" />
    </div>
  </router-view>
</template>

<script setup>
import { watch } from "vue";
import { useRoute } from "vue-router";

// Detect route
const route = useRoute();

// Update title automatically
watch(
  () => route.name,
  (newName) => {
    document.title = newName
      ? `${capitalize(newName)} | RememberME`
      : "RememberME";
  },
  { immediate: true }
);

function capitalize(text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
}
</script>
