<template>
<div v-on:mouseleave="isClicked = false">
  <span :class="{'text-decoration-line-through': todo.finished}"  v-on:click="isClicked = isClicked ? 0 : 1">{{ todo.title }}</span>
  <transition name="fade"><span v-if="isClicked">
    <button v-if="todo.finished" type="button" class="btn btn-info" @click="markUndone">[ Uncheck ]</button>
    <button v-else  type="button" class="btn btn-success" @click="markDone">[ Check ]</button>
    <button v-if="todo.urgent"  type="button" class="btn btn-info" @click="moveToRegular">[ To regular ]</button>
    <button v-else  type="button" class="btn btn-warning" @click="moveToUrgent">[ To urgent ]</button>
    <button type="button" class="btn btn-danger" @click="removeTodo">[ Delete ]</button>
  </span></transition>

</div>
</template>

<script>
export default {
  name: "TodoItemComponent",
  data(){
    return {
      isClicked: false,
    }
  },

  props:['todo'],

  methods:{
    markDone(){
      axios.post('/api/doings/markDone/'+this.todo.id)
          .then(() => (this.$emit('refresh-request')) )
          .catch(error => console.log(error));
    },

    markUndone(){
      axios.post('/api/doings/unmarkDone/'+this.todo.id)
          .then(() => (this.$emit('refresh-request')) )
          .catch(error => console.log(error));
    },

    moveToUrgent(){
      axios.post('/api/doings/moveToUrgent/'+this.todo.id)
          .then(() => (this.$emit('refresh-request')) )
          .catch(error => console.log(error));
    },

    moveToRegular(){
      axios.post('/api/doings/moveToRegular/'+this.todo.id)
          .then(() => (this.$emit('refresh-request')) )
          .catch(error => console.log(error));
    },

    removeTodo(){
      axios.delete('/api/doings/'+this.todo.id)
          .then(() => (this.$emit('refresh-request')) )
          .catch(error => console.log(error));
    },

  }
}
</script>

<style scoped>

</style>