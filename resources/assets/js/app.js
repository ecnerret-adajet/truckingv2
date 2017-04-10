
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
// Vue.component('logs', require('./components/Logs.vue'));

// const app = new Vue({
//     el: '#app',
//     data: {
//     	logs: []
//     },
//     created() {
//     axios.get('/logs').then((response) => {
//         this.logs = response.data;
//     });
// 	}
// });

const sidebar = new Vue({	

	el: '#email_table',
	data: {
		isDisable: false,
		newEmail: '',
		emails: [
			'terrence.tejada@gmail.com',
			'maggester.cruz@gmail.com',
			'marik.miro@lafilgroup.com',
			'gani.cotanas@lafilgroup.com'
		]
	},

	methods: {
		addEmail() {
			this.emails.push(this.newEmail);
			this.newEmail = '';
		}
	}


});
