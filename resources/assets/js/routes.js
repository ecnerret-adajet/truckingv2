import VueRouter from 'vue-router';

let routes = [

{
	path: '/dashboardx',
	component: require('./views/Dashboard.vue')
},
{
	path: '/drivers',
	component: require('./views/Drivers.vue')
},
{
	path: '/truckx',
	component: require('./views/Trucks.vue')
},
{
	path: '/haulers',
	component: require('./views/Haulers.vue')
},
{
	path: '/users',
	component: require('./views/Users.vue')
},
{
	path: '/in-plant',
	component: require('./views/Inplant.vue')
},
{
	path: '/in-transit',
	component: require('./views/Intransit.vue')
},
{
	path: '/entires',
	component: require('./views/Entries.vue')
}

];

export default new VueRouter({
	routes,
	linkActiveClass: 'active'
});