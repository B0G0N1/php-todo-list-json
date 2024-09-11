const { createApp } = Vue;

createApp({
    data() {
        return {
            todolist: [],
            newTask: '',
            errorMessage: ''
        };
    },
    methods: {
        addTask() {
            if (this.newTask.trim() === '') {
                this.errorMessage = 'Task cannot be empty!';
                return;
            }

            this.errorMessage = '';
            let task = {
                id: this.todolist.length + 1,
                done: false,
                name: this.newTask
            };

            axios.post('server.php', { addTask: task })
                .then(response => {
                    this.todolist = response.data;
                    this.newTask = '';  // Reset input
                })
                .catch(error => console.log(error));
        },
        toggleTask(id) {
            // Placeholder per il toggle
        },
        deleteTask(id) {
            // Placeholder per la cancellazione
        }
    },
    mounted() {
        axios.get('server.php')
            .then(response => {
                this.todolist = response.data;
            })
            .catch(error => console.log(error));
    }
}).mount('#app');