import { createStore } from "vuex";
import state from "./state";
import * as getters from "./getters";
import * as mutations from "./mutations";
import * as actions from "./actions";


const store = createStore({
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
});

export default store;

// export default {
//     namespaced: true,
//     state,
//     getters,
//     mutations,
//     actions
// }
