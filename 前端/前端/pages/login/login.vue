<template>
	<view>

		<view>
			<view>
				<view class='header'>
					<image src='../../static/image/wx_login.png'></image>
				</view>
				<view class='content'>
					<view>申请获取以下权限</view>
					<text>获得你的公开信息(昵称，头像、地区等)</text>
				</view>

				<button class='bottom' type='primary' open-type="getUserInfo" withCredentials="true" lang="zh_CN" @getuserinfo="getUserInfo">
					授权登录
				</button>
				
				<button class='bottom' type='primary' open-type="getUserInfo" withCredentials="true" lang="zh_CN" @click="quxiao">
					暂不登录
				</button>
			</view>
		</view>

	</view>
</template>
<script>
	import {
		
	} from 'vuex';
	export default {
		// computed: {  
		//           ...mapState(['userInfo'])
		//       },
		data() {
			return {
				
			}
		},
		onLoad() {
			
					// 获取用户信息
				var _self = this;
				_self.$uniApi.checkPhone("");
			
		},
		methods: {
			getUserInfo(){
				uni.login({
					provider: 'weixin',
					success: (res) => {
						if (res.errMsg == "login:ok") {
							this.code = res.code;
							uni.getUserInfo({
								provider: 'weixin',
								success: function(infoRes) {
								//console.log(infoRes.userInfo.nickName);
								
				uni.request({
					url:'https://kkwl.94wz.xyz/App/Zm/oneRegister',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},  
					method: 'POST',
					data: {
						uuid: res.code,
						avatarUrl: infoRes.userInfo.avatarUrl,
						nickName: infoRes.userInfo.nickName
					}, 
					success: (ret) => {
						console.log(JSON.stringify(ret.data));
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret.data.code == 1) {
										// 取数据并赋值
			 
			uni.setStorageSync('user_id', ret.data.msg.id);
			uni.setStorageSync('username', ret.data.msg.username);		 	  
			uni.setStorageSync('userimg', ret.data.msg.userimg);
			uni.setStorageSync('jifen', ret.data.msg.jifen);
			uni.setStorageSync('viptime', ret.data.msg.viptime);
			uni.setStorageSync('buy', ret.data.msg.buy);
			uni.setStorageSync('collect', ret.data.msg.collect);
									// 关闭动画
									uni.hideLoading();
									// 跳转到首页
									uni.reLaunch({
										url: '../index/index'
									});
									} else {
										// 关闭动画
										
										// 气泡提示
										uni.showToast({
											title: ret.data.msg,
											icon: 'none',
											duration: 2000
										});
									}
								}
							});				
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								},
								fail: () => {
								uni.showToast({ title: '获取用户信息失败', icon: 'none' });
								}
							});
	
						} else {
							uni.showToast({
								title: '系统异常，请联系管理员!'
							})
						}
					}
				})

			},quxiao(){
				uni.reLaunch({
					url: '../index/index'
				});
			}
			
		},


	}
</script>
<style>
	.header {
		margin: 90rpx 0 90rpx 50rpx;
		border-bottom: 1px solid #ccc;
		text-align: center;
		width: 650rpx;
		height: 300rpx;
		line-height: 450rpx;
	}

	.header image {
		width: 200rpx;
		height: 200rpx;
	}

	.content {
		margin-left: 50rpx;
		margin-bottom: 90rpx;
	}

	.content text {
		display: block;
		color: #9d9d9d;
		margin-top: 40rpx;
	}

	.bottom {
		border-radius: 80rpx;
		margin: 70rpx 50rpx;
		font-size: 35rpx;
	}
</style>
