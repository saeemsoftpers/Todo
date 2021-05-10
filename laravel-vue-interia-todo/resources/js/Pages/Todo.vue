<template>
    <div>
        <label>New Todo </label>
        <form @submit.prevent="addTodo">

            <input
                v-model="newTodo.name"
                name="name"
                id="name"
                autocomplete="off"

            >
            <button class="btn btn-primary"><i class="fa fa-plus"> </i> Add Task</button>
        </form>
        <ul class="list-group">
            <li
                v-for="(todo, index) in data"
                :key="index"
                class="list-group-item">
			<span
                :class="{done:todo.is_done}"
                @click="doneTodo(index)" style="color:black">{{ todo.name }}</span>
                <button @click="removeTodo(index)" class=" float-right" style=""><i
                    class="fa fa-trash"></i>*</button>
            </li>
        </ul>
        <h4 v-if="todos.length === 0">Empty list.</h4>
    </div>
</template>

<script>
import AppLayout from './../Layouts/AppLayout'
import Welcome from './../Jetstream/Welcome'

export default {
    components: {
        AppLayout,
        Welcome,
    },
    props: ['data'],
    data() {

        return {


            newTodo: {
                name: '',
                is_done: false
            },
            todos: [],
            errors: [],


        }
    },

    mounted() {

        console.log('this.props.data');


    },


    methods: {

        addTodo() {


            this.$inertia.post('/todo', {
                name: this.newTodo.name,
                done: 0

            });
            this.reset();
        },
        reset() {
            this.newTodo.name = '';
            this.newTodo.done = '';
        },
        doneTodo(index) {
            // this.todos[index].is_done=response.data.todo.is_done;
            // this.todos.is_done = !response.data.todo.is_done;
            console.log('index');
            console.log(this.data[index]['is_done']);
            this.$inertia.post('todo/done/' + this.data[index]['id'], {
                done: this.data[index]['is_done']

            });

        },

        removeTodo(index) {
            // todos.value.splice(index, 1);
            let conf = confirm("Do you ready want to delete this task?");

            if (conf === true) {
                this.$inertia.delete('todo/' + this.data[index]['id']);

            }
        },


    }
}

</script>

<style lang="scss">
$border: 2px solid rgba(
    $color: white,
    $alpha: 0.35,
);
$size1: 6px;
$size2: 12px;
$size3: 18px;
$size4: 24px;
$size5: 48px;
$backgroundColor: #393a3b;
$textColor: white;
$primaryColor: #a0a4d9;
$secondTextColor: #1f2023;
body {
    margin: 0;
    padding: 0;
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    background-color: $backgroundColor;
    color: $textColor;

    #app {
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        padding: 20px;

        h1 {
            font-weight: bold;
            font-size: 28px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 100%;

            label {
                font-size: 14px;
                font-weight: bold;
            }

            input,
            button {
                height: $size5;
                box-shadow: none;
                outline: none;
                padding-left: $size2;
                padding-right: $size2;
                border-radius: $size1;
                font-size: 18px;
                margin-top: $size1;
                margin-bottom: $size2;
            }

            input {
                background-color: transparent;
                border: $border;
                color: inherit;

            }
        }

        button {
            cursor: pointer;
            background-color: $primaryColor;
            border: 1px solid $primaryColor;
            color: $secondTextColor;
            font-weight: bold;
            outline: none;
            border-radius: $size1;
        }

        h2 {
            font-size: 22px;
            border-bottom: $border;
            padding-bottom: $size1;
        }

        ul {
            padding: 10px;

            li {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border: $border;
                padding: $size2 $size4;
                border-radius: $size1;
                margin-bottom: $size2;

                span {
                    cursor: pointer;
                }

                button {
                    font-size: $size2;
                    padding: $size1;
                }
            }
        }

        h4 {
            text-align: center;
            opacity: 0.5;
            margin: 0;
        }
    }

}

.done {
    text-decoration: line-through;
    text-decoration-color: blue;

}
</style>
