<template>
    <div>
        <h1>Séries</h1>
        <div>
            <input type="text" v-model="nova_serie" />
            <button @click="novaSerie">Adicionar</button>
        </div>
        <ul v-if="series" class="list-group">
            <li v-for="serie in series" class="list-group-item d-flex justify-content-between align-items-center">
                {{ serie.nome }}

                <span class="d-flex">
                    <a class="btn btn-primary btn-sm" @click="alterarSerie(serie)">
                        E
                    </a>
                    <button class="btn btn-danger btn-sm" @click="removerSerie(serie.id)">
                        X
                    </button>
                </span>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            nova_serie: "",
            series: [],
        };
    },
    mounted() {
        this.pegarSeries();
    },
    methods: {
        pegarSeries() {
            axios.get('/api/series').then(response => {
                this.series = response.data;
            })
        },
        novaSerie() {
            if (this.nova_serie === "") {
                return;
            }

            axios.post('/api/series', {
                nome: this.nova_serie
            }).then(response => {
                if (response.status === 201) {
                    this.pegarSeries();
                    this.nova_serie = "";
                }
            })

        },
        alterarSerie(serie) {
            let serie_alterada = prompt("Digite um novo valor", serie.nome);
            if (serie_alterada && serie_alterada !== serie.nome) {
                axios.put(`/api/series/${serie.id}`, {
                    nome: serie_alterada
                }).then(response => {
                    this.pegarSeries()
                })
            }
        },
        removerSerie(serie_id) {
            if (confirm('Deseja mesmo remover essa serie?')) {
                axios.delete(`/api/series/${serie_id}`).then(response => {
                    if (response.status === 400) {
                        alert('Deu ruim')
                    }

                    if (response.status === 200
                    ) {
                        alert('Registro apagado com sucesso!')

                        this.pegarSeries()
                    }
                })
            }

        }
    }
};
</script>
