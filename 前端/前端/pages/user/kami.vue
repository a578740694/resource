<template>
	<view class="body">
		<view>
			<image src="../../static/logo.png" style="margin-bottom: 4rem;width: 7rem;height:7rem;">	
		</view>
		<view class="login-content" >
			<view class="van-cell-van-field" style="background-color: #F1F1F5;">
				<view class="shu" >
					<view><input type="text" placeholder="输入卡密" class="text" v-model="kami"></view>
				</view>
			</view>	
			 
		</view>
		<view class="submit-btn"> 
			<view class="submit" @click="loginOff()">激活</view>
		</view>
		
	</view>	
</template>

<script>
	
	export default {
			data() {
				return {
					title: 'Hello',
					kami: '',
					inputValue:''
					//password: ''
				}
			},
			onLoad() {
				this.zhan();
				var kamikami = uni.getStorageSync('kamikami');
				this.kami = kamikami;
			}, 
			methods: {
				loginOff() { // 登录操作
				
				//console.log(this.kami);
				if(this.kami == ''){
					uni.showToast({
						title: 'ε=(´ο｀*))) 调皮~   激活码还没输入',
						duration: 2000,
						icon:"none"
					});
					return;
				  }
				  const user_id = uni.getStorageSync('user_id');
				  if (user_id) {
					  // 打开动画
					  uni.showLoading({
					  	title: '验证中...',
					  	mask: true
					  });
					  
					  uni.request({
					  	url: this.$serverUrl + '/App/Zm/dianka',
					  	method: 'GET',
					  	data: {
					  		uid: user_id,
					  		dianka: this.kami
					  	},
					  	success: (ret) => {
					  		//console.log(JSON.stringify(ret));
					  		if (ret.statusCode !== 200) {
					  			console.log('请求失败', ret);
					  			return;
					  		}
					  		if (ret.data.code == 1) {
					  			// 取数据并赋值
					  			uni.setStorageSync('viptime', ret.data.lasttime);
					  			// 气泡提示
					  			uni.showToast({
					  				title: '恭喜激活成功！',
					  				duration: 2000
					  			});
					  			// 关闭动画
					  			uni.hideLoading();
					  			// 跳转到首页
					  			uni.reLaunch({
					  				url: '../user/user'
					  			});
					  		}else if (ret.data.code == 0) {
					  			// 关闭动画
					  			uni.hideLoading();
					  			// 气泡提示
					  			uni.showToast({
					  				title: ret.data.msg,
					  				icon: 'none',
					  				duration: 2000
					  			});
					  		}
					  	}
					  });
					  
				  }else{
						 uni.navigateTo({
							url: '/pages/login/login'
						 });
					 }
	
				},zhan(){
					uni.getClipboardData({
					    success: function (res) {
							var t = res.data
							if(t.length == 20){
								 uni.setStorageSync('kamikami',res.data);
							}
					    
					    }
						
					});
				}
			}
		}
	
</script>

<style>
	.body{width: 100%;height: 100vh;overflow-y: scroll;background-color: #fff;background-repeat: no-repeat;background-size: cover;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;padding-top: 3rem;/* background: url(../../static/image/bg02.png) */;
}
.login-content{width: 100%; padding: 0 2rem;}
.van-cell-van-field{margin-bottom: 1rem;position: relative;display: flex;box-sizing: border-box;width: 100%;padding: 10px 16px;overflow: hidden;color: #323233;font-size: 14px;line-height: 24px;background-color: #fff;}
.shu{color: #323233;text-align: left;position: relative;overflow: hidden;vertical-align: middle;word-wrap: break-word;}
	.text{display: block;box-sizing: border-box;width: 100%;min-width: 0;margin: 0;padding: 0;color: #323233;text-align: left;background-color: transparent;border: 0;resize: none;}
	.submit-btn{padding: 2rem;padding-bottom: 0;width: 100%;}
	.submit{width: 100%;height: 2.53rem;line-height: 2.53rem;background: linear-gradient(to left,#ff700a,#F19E38);color: #fff;text-align: center;font-size: .9rem;font-weight: 700;}
</style> 
