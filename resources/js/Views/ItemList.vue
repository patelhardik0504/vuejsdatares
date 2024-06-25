<template>
    <div>
        <!-- Button to open modal -->
        <button @click="openModal()" class="btn btn-primary">Add Item</button>

        <!-- Table to display items -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.description }}</td>
                    <td>
                        <button @click="editItem(item)" class="btn btn-primary btn-sm">Edit</button>
                        <button @click="deleteItem(item.id)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal for Create/Edit -->
        <div class="modal" :class="{ 'show': showModal }" id="itemModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ formTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" @click="closeModal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="saveItem">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" v-model="formData.name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" v-model="formData.description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ formMode }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: [],
            formData: {
                id: null,
                name: '',
                description: ''
            },
            formMode: 'Create',
            formTitle: 'Create Item',
            showModal: false // Add a property to manage modal visibility
        };
    },
    mounted() {
        this.fetchItems();
    },
    methods: {
        fetchItems() {
            // Replace with API endpoint from Laravel
            axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                })
                .catch(error => {
                    console.error('Error fetching items: ' + error);
                });
        },
        openModal() {
           
            this.formData.id = null;
            this.formData.name = '';
            this.formData.description = '';
            this.formMode = 'Create';
            this.formTitle = 'Create Item';
            this.showModal = true; // Set showModal to true to show modal
            console.log( this.showModal);
        },
        closeModal() {
            // Reset form data and close modal
            this.formData.id = null;
            this.formData.name = '';
            this.formData.description = '';
            this.formMode = 'Create';
            this.formTitle = 'Create Item';
            this.showModal = false; // Set showModal to false to hide modal
        },
        saveItem() {
            if (this.formMode === 'Create') {
                axios.post('/api/items', this.formData)
                    .then(response => {
                        this.items.push(response.data);
                        this.closeModal();
                    })
                    .catch(error => {
                        console.error('Error creating item: ' + error);
                    });
            } else {
                axios.put(`/api/items/${this.formData.id}`, this.formData)
                    .then(response => {
                        // Update item in items array
                        const index = this.items.findIndex(item => item.id === response.data.id);
                        if (index !== -1) {
                            this.items.splice(index, 1, response.data);
                        }
                        this.closeModal();
                    })
                    .catch(error => {
                        console.error('Error updating item: ' + error);
                    });
            }
        },
        editItem(item) {
            this.formData.id = item.id;
            this.formData.name = item.name;
            this.formData.description = item.description;
            this.formMode = 'Edit';
            this.formTitle = 'Edit Item';
            this.showModal = true; // Open modal when editing item
            console.log( this.showModal);
        },
        deleteItem(itemId) {
            if (confirm('Are you sure you want to delete this item?')) {
                axios.delete(`/api/items/${itemId}`)
                    .then(() => {
                        this.items = this.items.filter(item => item.id !== itemId);
                    })
                    .catch(error => {
                        console.error('Error deleting item: ' + error);
                    });
            }
        }
    }
};
</script>
<style scoped>
/* Scoped styles if needed */

.modal {
    display: none; /* Hide modal by default */
    background: rgba(0, 0, 0, 0.5); /* Optional: semi-transparent background */
}

.modal.show {
    display: block; /* Show modal when 'show' class is present */
}
</style>