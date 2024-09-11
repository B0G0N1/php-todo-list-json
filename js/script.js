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

            axios.post('server.php', new URLSearchParams({
                addTask: JSON.stringify(task)
            }))
            .then(response => {
                this.todolist = response.data;
                this.newTask = '';  // Reset del campo input
            })
            .catch(error => console.log(error));
        },
        toggleTask(id) {
            axios.post('server.php', new URLSearchParams({
                toggleTask: id
            }))
            .then(response => {
                this.todolist = response.data;  // Aggiorna la lista dopo il toggle
            })
            .catch(error => console.log(error));
        },
        deleteTask(id) {
            axios.post('server.php', new URLSearchParams({
                deleteTask: id
            }))
            .then(response => {
                this.todolist = response.data;
            })
            .catch(error => console.log(error));
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