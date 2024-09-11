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
            // Verifica che il campo di input non sia vuoto
            if (this.newTask.trim() === '') {
                this.errorMessage = 'Task cannot be empty!';
                return;
            }

            this.errorMessage = '';

            // Definisci l'oggetto task da inviare al server
            let task = {
                id: this.todolist.length + 1,
                done: false,
                name: this.newTask
            };

            // Invia la nuova task tramite POST al server
            axios.post('server.php', new URLSearchParams({
                addTask: JSON.stringify(task)
            }))
            .then(response => {
                this.todolist = response.data;
                this.newTask = '';  // Resetta il campo di input dopo l'aggiunta
            })
            .catch(error => console.log(error));
        },
        toggleTask(id) {
            // Funzione per il toggle dello stato delle task
        },
        deleteTask(id) {
            // Funzione per eliminare le task
        }
    },
    mounted() {
        // Ottieni la lista delle task dal server al caricamento della pagina
        axios.get('server.php')
            .then(response => {
                this.todolist = response.data;
            })
            .catch(error => console.log(error));
    }
}).mount('#app');