import { createStore } from "vuex";
const store = createStore({
  state: {
    data: "The state item",
    user: {
      id: 1,
      name: "MD BIPLOB MIA",
      mobile: "01725361208",
      address: "93/A, Bashir Uddin Road, Kalabagan, Dhaka-1205",
      role: "Super Admin",
    },
    books: [
      {
        name: "Book for Science",
        author: "Abdul hamid Khan",
      },
      {
        name: "Book for Bangla",
        author: "Sabbir Rahman",
      },
      {
        name: "Book for English",
        author: "Bappi Khan",
      },
    ],
    services: {},
  },
  actions: {},
  getters: {},
  mutations: {},
});

export default store;
