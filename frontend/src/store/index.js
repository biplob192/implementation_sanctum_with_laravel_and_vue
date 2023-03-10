import { createStore } from "vuex";
import state from "./state";
import * as getters from "./getters";
import * as mutations from "./mutations";
import * as actions from "./actions";

// Import Modules
import sample from "./modules/sample";

const store = createStore({
  state,
  getters,
  mutations,
  actions,

  modules: {
    sample,
  },
});

export default store;
