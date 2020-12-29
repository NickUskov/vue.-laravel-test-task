<template>
  <div class="wrapper">
    <div class="header">
      <label for="INN" style="display: block">Введите ИНН</label>
      <label for="" v-if="text.length > 0 && text.length != 12">
        ИНН должен состоять из 12 цифр
      </label>
      <input placeholder="ИНН должен состоять из 12 цифр"
             id="INN"
             type="number"
             v-model="text">
      <button :disabled="text.length!=12?true:false"
              @click="find">Найти
      </button>
    </div>
    <div class="content">
      <div v-if="data && data.length > 0">
        <div class="content__list-item" :key="index" v-for="(el,index) in data">
          <div>
            <span><b>Наименование: </b></span>
            <span>{{el.name}}</span>
          </div>
          <div>
            <span><b>КПП: </b></span>
            <span>{{el.kpp}}</span>
          </div>
        </div>
      </div>
      <div v-if="data && data.length === 0">
        <p>Данных по компании с данным ИНН не найдено...</p>
      </div>
    </div>
  </div>
</template>

<script>
    import {ref} from 'vue'

    export default {
        name: 'App',
        setup() {
            let text = ref('')
            let data = ref(null)
            const find = () => {
                fetch(`http://127.0.0.1:8000/api/inn/${text.value}`)
                    .then(res => res.json())
                    .then(r => {
                        if(r.length != 0) {
                            data.value = [r]
                        } else {
                            data.value = []
                        }
                    })
            }
            return {
                data,
                text,
                find
            }
        }
    }
</script>

<style lang="scss">
  * {
    box-sizing: border-box;
  }

  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }

  .wrapper {
    margin: 0 auto;
    width: 600px;
    box-shadow: 3px 3px 30px rgba(0, 0, 0, .5);
    display: flex;
    flex-direction: column;

    .header {
      text-align: left;
      display: flex;
      flex-direction: column;
      align-items: start;
      color: #fff;
      padding: 15px;
      width: 100%;
      background: #471A3B;

      button {
        cursor: pointer;
        background: #943779;
        border: none;
        color: #fff;
        padding: 5px;
        font-size: 16px;
        font-weight: 700;
        transition: .1s;

        &:disabled {
          color: grey;
          cursor: not-allowed;
          background: #FF280F1F;
        }
      }

      box-shadow: 0 10px 15px rgba(0, 0, 0, .2);

      & > input {
        padding: 5px;
      }

      & > * {
        width: 100%;
        margin-bottom: 1rem;
      }
    }

    .content {
      width: 100%;
      overflow-y: auto;

      .content__list-item {
        padding: 10px;
        width: 100%;
        border-bottom: 1px solid #d4becf;
        background: #eee8ed;
        display: flex;
        align-items: start;
        flex-direction: column;
        & > div {
          margin-bottom: 1rem;
        }
      }
    }
  }
</style>
