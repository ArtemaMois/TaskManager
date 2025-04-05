import { Centrifuge } from "centrifuge";
import { createStore } from "vuex";

const store = createStore({
    state(){
        return {
            centrifuge: {}
        };
    },
    getters: {
        getCentrifuge(state)
        {
            return state.centrifuge;
        }
    },
    mutations:{
        setCentrifuge(state, centrifuge)
        {
            state.centrifuge = centrifuge;
        }
    },
    actions: {
        async setCentrifuge({state, commit}, wsToken)
        {
            const centrifuge = new Centrifuge(
                'ws://localhost:8427/connection/websocket',
                {
                    token: wsToken,
                }
            );
            centrifuge.connect();
            commit('setCentrifuge', centrifuge);
        }
    }
});

export default store;