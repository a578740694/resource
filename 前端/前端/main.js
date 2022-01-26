import Vue from 'vue'
import App from './App'

Vue.config.productionTip = false
Vue.prototype.$serverUrl = 'https://kkwl.94wz.xyz';
App.mpType = 'app'
  
const app = new Vue({
    ...App
}) 
const checkPhone = beijing=>{
	var backgroundColor =  uni.getStorageSync('backgroundColor');
	var frontColor = uni.getStorageSync('frontColor');
	
	if(frontColor==1){
		uni.setNavigationBarColor({
			frontColor: '#ffffff',
		    backgroundColor: backgroundColor,
		    animation: {
		        duration: 400,
		        timingFunc: 'easeIn'
		    }
		})
	}else{
		uni.setNavigationBarColor({
			frontColor: '#000000',
		    backgroundColor: backgroundColor,
		    animation: {
		        duration: 400,
		        timingFunc: 'easeIn'
		    }
		})
	}
}
Vue.prototype.$uniApi={checkPhone};
app.$mount()
