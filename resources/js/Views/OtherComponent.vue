<template>
  <div>
    <h2>Dynamic Input Boxes</h2>
    <button @click="addInput">Add Input</button>
    
    <div v-for="(input, index) in inputs" :key="index" class="input-group">
      <label :for="'input' + index">Input {{ index + 1 }}</label>
      <input
        :id="'input' + index"
        v-model="input.value"
        @input="updateInput(index, 'value', $event.target.value)"
      />
      <label :for="'textarea' + index">Text Area {{ index + 1 }}</label>
      <textarea
        :id="'textarea' + index"
        v-model="input.textarea"
        @input="updateInput(index, 'textarea', $event.target.value)"
      ></textarea>
      <button @click="removeInput(index)" class="close-button">X</button>
    </div>

    <div>
      <h3>Form Data</h3>
      <pre>{{ inputs }}</pre>
    </div>
  </div>
</template>




<script>
export default {
  name: 'OtherComponent',
  data() {
    return {
      inputs: [{ value: '' }] // Initialize with one input box
    };
  },
  methods: {
    addInput() {
      this.inputs.push({ value: '' });
    },
    removeInput(index) {
      if (this.inputs.length > 1) {
        this.inputs.splice(index, 1);
      }
    },
    updateInput(index, value) {
      this.inputs[index].value = value;
    }
  }
};
</script>

<style scoped>
.input-group {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.input-group input {
  margin-right: 10px;
}

.close-button {
  background-color: red;
  color: white;
  border: none;
  padding: 5px;
  cursor: pointer;
}

.close-button:hover {
  background-color: darkred;
}
</style>


  