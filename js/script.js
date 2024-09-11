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
            // Placeholder per la funzione di aggiunta
        },
        toggleTask(id) {
            // Placeholder per la funzione di toggle
        },
        deleteTask(id) {
            // Placeholder per la funzione di cancellazione
        }
    },
    mounted() {
        // Ottenere la lista delle task dal server
        axios.get('server.php')
            .then(response => {
                this.todolist = response.data;
            })
            .catch(error => console.log(error));
    }
}).mount('#app');