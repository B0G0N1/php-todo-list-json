const { createApp } = Vue;

createApp({
    data() {
        return {
            todolist: [],      // Array per memorizzare la lista delle task
            newTask: '',       // Stringa per memorizzare la nuova task da aggiungere
            errorMessage: ''   // Stringa per memorizzare eventuali messaggi di errore
        };
    },
    methods: {
        // Metodo per aggiungere una nuova task
        addTask() {
            if (this.newTask.trim() === '') {
                this.errorMessage = 'Task cannot be empty!';
                return;
            }

            this.errorMessage = '';

            // Crea un oggetto task con stato "done" impostato a false e il nome della task
            let task = {
                done: false,                  // Task non completata di default
                name: this.newTask            // Nome della nuova task
            };

            // Invia la nuova task al server tramite POST
            axios.post('server.php', new URLSearchParams({
                addTask: JSON.stringify(task)  // Passa la task come stringa JSON
            }))
            .then(response => {
                this.todolist = response.data; // Aggiorna la lista delle task con la risposta del server
                this.newTask = '';             // Reset del campo di input
            })
            .catch(error => console.log(error)); // Gestione errori
        },
        // Metodo per fare il toggle (completa/non completa) di una task
        toggleTask(id) {
            axios.post('server.php', new URLSearchParams({
                toggleTask: id                 // Passa l'ID della task da completare/non completare
            }))
            .then(response => {
                this.todolist = response.data; // Aggiorna la lista dopo il toggle
            })
            .catch(error => console.log(error)); // Gestione errori
        },
        // Metodo per eliminare una task dalla lista
        deleteTask(id) {
            axios.post('server.php', new URLSearchParams({
                deleteTask: id                 // Passa l'ID della task da eliminare
            }))
            .then(response => {
                this.todolist = response.data; // Aggiorna la lista dopo l'eliminazione
            })
            .catch(error => console.log(error)); // Gestione errori
        }
    },
    // Funzione che viene eseguita quando il componente viene montato (caricato)
    mounted() {
        // Ottieni la lista delle task dal server al caricamento della pagina
        axios.get('server.php')
            .then(response => {
                this.todolist = response.data; // Imposta la lista delle task
            })
            .catch(error => console.log(error)); // Gestione errori
    }
}).mount('#app');