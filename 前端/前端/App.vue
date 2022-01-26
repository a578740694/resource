<script>
	export default {
		onLaunch: function() {
		
		},
		onShow: function() {
		 const user_id = uni.getStorageSync('user_id');
		 		uni.request({
		 			url: this.$serverUrl + '/App/Zm/uuid',
		 			header: {
		 				'content-type': 'application/x-www-form-urlencoded', 
		 			},
		 			method: 'POST',
		 			data: {
		 				uid: user_id	
		 			},
		 			success: (ret) => {
		 				//console.log(JSON.stringify(ret.data));
		 				if (ret.statusCode !== 200) {
		 					console.log('请求失败', ret);
		 					return;
		 				}
		 				if (ret.data.code == 1) {
		 					uni.removeStorageSync('user_id');
		 					uni.removeStorageSync('username');
		 					uni.removeStorageSync('jifen');
		 					uni.removeStorageSync('userimg');
		 					uni.removeStorageSync('buy');
		 					uni.removeStorageSync('collect');
		 					uni.removeStorageSync('viptime');
		 				}
		 			}
		 				});
		 
		 
		
		 	let that = this;
		 	uni.request({
		 		url: that.$serverUrl + '/App/Zm/config',
		 		header: {
		 			'content-type': 'application/x-www-form-urlencoded', 
		 		}, 
		 		method: 'POST',
		 		data: {},
		 		success: (ret) => {
		 		//console.log(JSON.stringify(ret.data.msg));
		 			if (ret.statusCode !== 200) {
		 				console.log('请求失败', ret);
		 				return;
		 			}
		 			if (ret.data.code == 1) {
		 uni.setStorageSync('wenti', ret.data.msg.wenti);
		 uni.setStorageSync('about', ret.data.msg.about);
		 uni.setStorageSync('yi', ret.data.msg.yi);
		 uni.setStorageSync('er', ret.data.msg.er);
		 uni.setStorageSync('san', ret.data.msg.san);
		 uni.setStorageSync('si', ret.data.msg.si);
		 uni.setStorageSync('wu', ret.data.msg.wu);
		 uni.setStorageSync('liu', ret.data.msg.liu);
		 uni.setStorageSync('qi', ret.data.msg.qi);
		 uni.setStorageSync('banner', ret.data.msg.banner);
		 uni.setStorageSync('jili', ret.data.msg.jili);
		 uni.setStorageSync('cha', ret.data.msg.cha);
		 uni.setStorageSync('shipin', ret.data.msg.shipin);
		 uni.setStorageSync('gezi', ret.data.msg.gezi);
		 uni.setStorageSync('scout', ret.data.msg.scout);
		 uni.setStorageSync('notice', ret.data.msg.notice);
		 uni.setStorageSync('yiyue', ret.data.msg.yiyue);
		 uni.setStorageSync('liuyue', ret.data.msg.liuyue);
		 uni.setStorageSync('shier', ret.data.msg.shier);
		 uni.setStorageSync('zanshang', ret.data.msg.zanshang);
		 uni.setStorageSync('backgroundColor', ret.data.msg.backgroundColor);
		 uni.setStorageSync('frontColor', ret.data.msg.frontColor);
		uni.setStorageSync('appname', ret.data.msg.appname);
		  
		uni.setStorageSync('indexb', ret.data.msg.indexb);
		uni.setStorageSync('indexg', ret.data.msg.indexg);
		uni.setStorageSync('indexs', ret.data.msg.indexs);
		uni.setStorageSync('typeb', ret.data.msg.typeb);
		uni.setStorageSync('types', ret.data.msg.types);
		uni.setStorageSync('faxians', ret.data.msg.faxians);
		uni.setStorageSync('users', ret.data.msg.users);
		uni.setStorageSync('buyg', ret.data.msg.buyg);
		uni.setStorageSync('cong', ret.data.msg.cong);
		uni.setStorageSync('faqg', ret.data.msg.faqg);
		uni.setStorageSync('aboutg', ret.data.msg.aboutg);
		uni.setStorageSync('lists', ret.data.msg.lists);
		uni.setStorageSync('chag', ret.data.msg.chag);
		uni.setStorageSync('detab', ret.data.msg.detab);		
		uni.setStorageSync('detas', ret.data.msg.detas);
		uni.setStorageSync('vipk', ret.data.msg.vipk);
		uni.setStorageSync('resou', ret.data.msg.resou); 
		uni.setStorageSync('biaoqian', ret.data.msg.biaoqian); uni.setStorageSync('gonggao', ret.data.msg.gonggao); 
		uni.setStorageSync('title', ret.data.msg.title); 
		uni.setStorageSync('nei', ret.data.msg.nei); 
		uni.setStorageSync('tanstatus', ret.data.msg.tanstatus); 
		 			}
		 		}
		 	});
			
			let chag = uni.getStorageSync('chag');
			if(chag==1){
				let cha = uni.getStorageSync('cha');
				setTimeout(()=>{
					// 在页面中定义插屏广告
					let interstitialAd = null
					
					// 在页面onLoad回调事件中创建插屏广告实例
					if (wx.createInterstitialAd) {
					  interstitialAd = wx.createInterstitialAd({
					    adUnitId: cha
					  })
					  interstitialAd.onLoad(() => {})
					  interstitialAd.onError((err) => {})
					  interstitialAd.onClose(() => {
						  uni.stopPullDownRefresh();
					  })
					}
					
					// 在适合的场景显示插屏广告
					if (interstitialAd) {
					  interstitialAd.show().catch((err) => {
					    console.error(err)
					  })
					}
				},10000) 
			}
			
			
			
		},  
		onHide: function() {
			
		}    
	}
</script>

<style>
	/*每个页面公共css */
	@import './common/uni.css';
	@import './common/icon.css';
	@import "colorui/main.css";
	@import "colorui/icon.css";
	/* 公共样式 */
	@import "/common/common.css";
</style>
