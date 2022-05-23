<template>
    <div class="container">
      <div v-if="loading">Loading...</div>
        <div class="row justify-content-center" v-else>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Todo ({{ Object.keys(todoList.todos).length }})</div>
                    <div class="card-body">
                        <todo-item-component v-for="todo in todoList.todos" v-bind:todo="todo" v-bind:key="todo.id" v-on:refresh-request="refreshList()">
                        </todo-item-component>
                      <div>
                        <div class="input-group">
                          <input type="text" v-model="newTodo" v-on:keyup.enter="addTodo" class="form-control" placeholder="Type to add Todo" aria-label="Type to add Todo">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" @click="addTodo">Add</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header" :class="{'alert-danger': Object.keys(todoList.urgent).length > 3}">Urgent ({{ Object.keys(todoList.urgent).length }})</div>
              <div class="card-body">
                <todo-item-component v-for="todo in todoList.urgent" v-bind:todo="todo" v-bind:key="todo.id" v-on:refresh-request="refreshList()">
                </todo-item-component>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
import TodoItemComponent from "./TodoItemComponent";
import axios from 'axios';

    export default {
        name: 'TodoComponent',

      data(){
          return {
            todoList: [],
            loading: true,
            newTodo: '',
          }
      },

      components:{
          'todo-item-component':TodoItemComponent,
      },

      mounted() {
        this.refreshList();
      },


      methods: {
        refreshList(){
          axios.get('/api/doings')
              .then(response => ( this.todoList = response.data))
              .catch(error => console.log(error))
              .finally(() => (this.loading = false));
        },

        addTodo(){
          axios.put('/api/doings',{'title':this.newTodo})
              .then(() => ( this.refreshList() ))
              .catch(error => console.log(error))
              .finally(() => (this.newTodo = null));
        },
      },
    }
</script>

<style scoped>

</style>