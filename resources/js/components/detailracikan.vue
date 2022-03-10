<template>
	<div class="card">
        <div class="card-body">
			<div class="form-group">
	            <label>Obat / alat kesehatan {{index}}</label>
	            <v-select v-model="selectedObat" :getOptionLabel="(option) => `${option.obatalkes_kode} ( stok: ${option.stok} ) - ${option.obatalkes_nama}`" :options="obatList" :reduce="(option) => option.id" :selectable="(option) => option.stok > 0 " @option:selected="optionSelected" placeholder="Pilih obat"></v-select>
	        </div>
			<div class="form-group">
	            <label>Kuantitas obat {{index}}</label>
	            <input v-model='qty' type="number" name="name" class="form-control" placeholder="Nama" aria-label="name" aria-describedby="basic-addon1" @change="() => { if(qty > maxQty || qty < 0) { this.qty = maxQty }}"/> 
	            <small class="form-text text-muted">* Sisa stok = {{ maxQty - qty }} </small>                          
	        </div>
	    </div>
	</div>
</template>
<script>
export default {
	props:['obatList', 'index' ],
	data(){
		return{
			selectedObat:null,
			maxQty:0,
			qty:0,
			selectedEjaan:null,
		}
	},

	methods: {
        optionSelected(option) {	
        	this.maxQty = option.stok;
        	this.selectedEjaan = option.obatalkes_kode+" - "+option.obatalkes_nama;
        },
    },
}
</script>