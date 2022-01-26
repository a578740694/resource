<template>
	<view>
		
		<view class="mine_head" v-if="hasLogin">
			
			<view class="mine_head_body" >
				<view class="tx">
					<image :src="userimg" mode="" style="width: 100%;height: 100%;" @click="outLogin()"></image>
				</view>  
				<view class="nickname">{{usernc}}</view>
				<view class="idno" v-if="tishi">VIP将于：{{enddate| timeStamp}} 到期</view>
				<view class="idno" v-else>您目前还不是会员哦~</view>
			</view>
			
			<image src='../../static/image/sb.gif' mode='scaleToFill' class='gif-wave'></image>
		</view>
		
		<view class="mine_head" @click="openlogin()" v-else>
			
			
			
			<view class="mine_head_body">
				
				<view class="tx">
					<image src="../../static/image/logo-w.png" mode="" style="width: 100%;height: 100%;"></image>
				</view>  
				<view class="nickname">登录/注册</view>
				<!-- <view class="idno">UUID：{{userid}}</view> -->
			</view>
			
			<image src='../../static/image/sb.gif' mode='scaleToFill' class='gif-wave'></image>
		</view>
		
		
		
		
		
		
		
		
		
		<view class="mine_info_grid">
			<view class="mine_info">
				<view class="num">{{userjifen}}</view>
				<view>会员积分</view>
			</view>
			<view class="mine_info" style="border-left: 1px solid #e4e5ea;-webkit-tap-highlight-color: transparent;" @click="openBuy()">
				<view class="num">{{goumai}}</view>
				<view>兑换记录</view>
			</view>
			<view class="mine_info" style="border-left: 1px solid #e4e5ea;-webkit-tap-highlight-color: transparent;" @click="openCollect()">
				<view class="num">{{shoucang}}</view>
				<view>收藏记录</view>
			</view>
		</view>
		<view class="" style="width:100%;height:8px;background-color:#F1F1F5;"></view>
		
		
		
		
		
			<!-- 信息篮 -->
			<view class="aui-card-white">
				<view class="aui-well-item"@click="getVideoAd()">
					<view class="aui-well-item-hd" style="width:16px;height:16px;" >
						<image src="../../static/image/qian.png" alt="">
					</view>
					<view class="aui-well-item-bd-x"  >
						<view class="aui-well-item-bd-x-h">每日签到</view>  
					</view>
					<view class="aui-well-item-fr-jiao">
						<view class="tb"></view>
					</view>
					<view class="hengx"></view>
				</view>
				<view class="aui-well-item"  @click="openWin('user','vip')" v-if="vipk!=2">
					<view class="aui-well-item-hd" style="width:16px;height:16px;">
						<image src="../../static/image/shengji.png" alt="" >
					</view>
					<view class="aui-well-item-bd-x" @click="openVip()">
						<view class="aui-well-item-bd-x-h">积分兑换</view>
					</view>
					<view class="aui-well-item-fr-jiao">
						<view class="tb"></view>
					</view>
					<view class="hengx"></view>
				</view>
				
				
				<view class="aui-well-item" @click="openWin('user','faq')">
					<view class="aui-well-item-hd" style="width:16px;height:16px;" >
						<image src="../../static/image/shiyong.png" alt="">
					</view>
					<view class="aui-well-item-bd-x" @click="openWin('user','part')" >
						<view class="aui-well-item-bd-x-h">使用说明</view>  
					</view>
					<view class="aui-well-item-fr-jiao">
						<view class="tb"></view>
					</view>
					<view class="hengx"></view>
				</view>
				
		
		<button open-type='contact' session-from='' hover-class='none'>
				<view class="aui-well-item" >
					<view class="aui-well-item-hd" style="width:16px;height:16px;">
						<image src="../../static/image/lianxi.png" alt="" >
					</view>
					<view class="aui-well-item-bd-x" >
						<view class="aui-well-item-bd-x-h">联系我们</view>
					</view>
					<view class="aui-well-item-fr-jiao">
						<view class="tb"></view>
					</view>
					<view class="hengx"></view>
				</view>
		</button>		
		
				<view class="aui-well-item"  @tap="previewImg()" >
					<view class="aui-well-item-hd" style="width:16px;height:16px;">
						<image src="../../static/image/zan.png" alt="">
					</view>
					<view class="aui-well-item-bd-x">
						<view class="aui-well-item-bd-x-h">赞赏支持</view>
					</view>
					<view class="aui-well-item-fr-jiao">
						
						<view class="tb"></view>
					</view>
					<view class="hengx"></view>
				</view>
				<view class="aui-well-item"  @click="openWin('user','about')">
					<view class="aui-well-item-hd" style="width:16px;height:16px;">
						<image src="../../static/image/guanyu.png" alt="">
					</view>
					<view class="aui-well-item-bd-x">
						<view class="aui-well-item-bd-x-h">关于我们</view>
					</view>
					<view class="aui-well-item-fr-jiao">
						<view class="tb"></view>
					</view>
					<view class="hengx"></view>
				</view>
				<view class="aui-well-item"  @click="openWin('user','gengduo')">
					<view class="aui-well-item-hd" style="width:16px;height:16px;">
						<image src="../../static/image/4.png" alt="">
					</view>
					<view class="aui-well-item-bd-x">
						<view class="aui-well-item-bd-x-h">更多好玩</view>
					</view>
					<view class="aui-well-item-fr-jiao">
						<view class="tb"></view>
					</view>
					<view class="hengx"></view>
				</view>
			</view>
		
		
		
		
		<view  style="    width: 100%;position: relative;overflow: hidden;padding: 0 15px; padding-top: 10px;" v-if="users!=2">
			<view style="border-radius: 12px;padding-bottom: 5px;">
		<ad v-if="shipin!=0" :unit-id="shipin" ad-type="video" ad-theme="white"></ad>
		</view>
		</view>
		
		
		
	</view>
</template>

<script>
	let rewardedVideoAd = null;
	// 在页面中定义激励视频广告
	let videoAd = null
	export default {
	data() {
		return {
			hasLogin: false,
			usernc:'',
			userimg:'',
			userid:'',
			userjifen:'0',
			goumai:'0',
			shoucang:'0',
			enddate:'',
			shipin:'',
			users:'',
			tishi:'',
			vipk:''
			
	    }
	}, 
	onShow(e){
		this.isLogin();
		var _self = this;
		_self.$uniApi.checkPhone("");
		this.shipin =uni.getStorageSync('shipin');
		this.users =uni.getStorageSync('users');
		this.vipk =uni.getStorageSync('vipk');
		this.CreateAd();
	},
	filters: {
		timeStamp: function(value) {
			if (!value) return '';
			var now = new Date(value* 1000);
			//console.log("time:" + JSON.stringify(now));
			var year = now.getFullYear();
			var month = now.getMonth() + 1;
			if (month < 10) {
				month = '0' + month
			}
			var date = now.getDate();
			if (date < 10) {
				date = '0' + date
			}
			return year + "-" + month + "-" + date
		},
	},
	methods: {
		CreateAd(){
			let that = this;
			let jili = uni.getStorageSync('jili');
			if (wx.createRewardedVideoAd) {
				that.videoAd = wx.createRewardedVideoAd({
					adUnitId: jili
				})
				that.videoAd.onLoad(() => {})
				that.videoAd.onError((err) => {
					uni.showToast({
						icon: 'none',
						title: "观看失败,请稍后重试1"
					})
				})
				that.videoAd.onClose((res) => {
					if (res && res.isEnded) {
						// uni.showToast({
						// 	icon: 'none',
						// 	title: "感谢您的支持"
						// })
			
						this.qiandao();
					} else {
						uni.showToast({
							icon: 'none',
							title: "中途关闭广告"
						})
						
					}
				})
			}
		},
		getVideoAd(){
			// 用户触发广告后，显示激励视频广告
		
		let that = this;
		uni.showModal({
			title: '提示',
			content: '观看一段广告,即可获得奖励！',
			confirmColor:'#FF4400',
			
			
			success: function(res) {
				if (res.confirm) {
					
			if (that.videoAd) {
				that.videoAd.show().catch(() => {
					// 失败重试
					that.videoAd.load()
						.then(() => that.videoAd.show())
						.catch(err => {
							console.log('激励视频 广告显示失败')
							uni.showToast({
								icon: 'none',
								title: "观看失败,请稍后重试"
							})
						
						})
				})
			}
			
			}
				}
			});
			
		},
		isLogin(){
			const user_id = uni.getStorageSync('user_id');
			if (user_id) {
				this.hasLogin = true;
				this.usernc = uni.getStorageSync('username');
				this.userimg = uni.getStorageSync('userimg');
				this.userid = uni.getStorageSync('user_id');
				this.userjifen = uni.getStorageSync('jifen');
				this.goumai= uni.getStorageSync('buy');
				this.shoucang= uni.getStorageSync('collect');
				var viptime = uni.getStorageSync('viptime');
				var nowTime = Date.parse(new Date())/1000;
				this.enddate =viptime;
				if (viptime>nowTime) {
					this.tishi = true;
					//this.openHuo(tid,title,picname);
				}else{
					this.tishi = false;
				}
				//console.log(uni.getStorageSync('collect'))
			}else{ 
				this.hasLogin = false;
				this.userjifen=0;
				this.goumai=0;
				this.shoucang=0;
			}
		},
		// 预览图片单张
		previewImg() {
		let _this = this;
		let imgsArray = [];
		imgsArray[0] =  uni.getStorageSync('zanshang');
		uni.previewImage({
		current: 0,
		urls: imgsArray
		});
		},
		openWin(type,list){
			uni.navigateTo({
				url: '/pages/'+type+'/'+list
			});
		},outLogin() { //退出登录
				uni.showModal({
					title: '提示',
					content: '确定退出登录',
					confirmColor:'#FF4400',
					success: function(res) {
						if (res.confirm) {
							// 清除账号缓存
							uni.removeStorageSync('user_id');
							uni.removeStorageSync('username');
							uni.removeStorageSync('jifen');
							uni.removeStorageSync('userimg');
							
							// 跳转到首页
							uni.reLaunch({
								url: '../user/user'
							});
						} else if (res.cancel) {
							console.log('用户点击取消');
						}
					}
				});
			},openlogin() {
				uni.navigateTo({
					url: '/pages/login/login'
				});
			},openVip(){
				const user_id = uni.getStorageSync('user_id');
				if (user_id) {
					uni.navigateTo({
						url: '/pages/user/vip'
					});
				} else {
					uni.navigateTo({
						url: '/pages/login/login'
					});
				}	
			},openCollect(){
				const user_id = uni.getStorageSync('user_id');
				if (user_id) {
					uni.navigateTo({
						url: '/pages/user/collect'
					});
				} else {
					uni.navigateTo({
						url: '/pages/login/login'
					});
				}	
			},openBuy(){
				const user_id = uni.getStorageSync('user_id');
				if (user_id) {
					uni.navigateTo({
						url: '/pages/user/buy'
					});
				} else {
					uni.navigateTo({
						url: '/pages/login/login'
					});
				}	
			},qiandao(){
				var user_id = uni.getStorageSync('user_id');
				
				uni.request({
					url: this.$serverUrl + '/App/Zm/qiandao',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {
						uid:user_id
					},
					success: (ret) => {
						//console.log(JSON.stringify(ret.data.msg));
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret.data.code == 1) {
							uni.setStorageSync('jifen', ret.data.msg);
							this.$forceUpdate(this.isLogin());
							
							uni.showToast({
								title: '签到成功获得奖励！',
								icon: 'none',
								duration: 2000,
							});
							
						} else {
							uni.showToast({
								title: '今日已经签过了！',
								icon: 'none',
								duration: 2000,
							});
						}
					}
				});
			}
	}
	} 
</script>
  
<style>
	page{background-color: #fff;}
	.mine_head{background: linear-gradient(to top,#ff700a,#F19E38);position: relative;padding-bottom: 40%;color: white;background-repeat: no-repeat;background-position: center center;background-size: cover;}
	.mine_head_body{position: absolute;z-index: 10;left: 0;right: 0;top: 45%;transform: translateY(-50%);}
	.tx{margin: 0 auto;width: 63px;height: 63px;font-size: 0;margin-bottom: 10px;overflow: hidden;border: 1px solid #e0e0ef;background-color: #e0e0ef;border-radius: 50%;}
	.nickname{text-align: center;font-size: 16px;}
	.idno{text-align: center;font-size: 13px;/* margin-top: 1px; */}
	.mine_info_grid {background-color: white;padding: 14px 0;display: flex;-webkit-box-align: center;align-items: center;}
	.mine_info {color: #494949;font-size: 12px;text-align: center;box-sizing: border-box;flex: 1;width: 20%;-webkit-box-flex: 1;}
	.num {color: #d8b362;font-size: 22px;margin-bottom: 5px;}
	
	
	
	.aui-well-item-h {
		padding: 7px;
		position: relative;
		display: flex;
		-webkit-box-align: center;
		align-items: center;
	}
	
	.aui-well-item-hd-h {
		margin-right: .8em;
		width: 25px;
		height: 25px;
		line-height: 25px;
		text-align: center;
	}
	
	.aui-well-item-bd {
		-webkit-box-flex: 1;
		flex: 1;
		min-width: 0;
	}
	
	.aui-well-item-bd-h3 {
		color: #a36c3b;
		font-size: 0.7rem;
	}
	
	.aui-well-item-fr {
		font-size: 0.75rem;
		text-align: right;
		color: #EDD5B1;
		position: relative;
		background: #332615;
		border-radius: 16px;
		height: 30px;
		width: 85px;
		text-align: center;
		line-height: 33px;
	}
	
	.aui-card-white {height: auto;box-shadow: 0 1px 16px 0 rgba(0, 0, 0, .1);margin-bottom: 12px;}
	
	.aui-palace {
		padding: 5px 0px;
		position: relative;
		overflow: hidden;
	}
	
	.aui-palace-grid {
		width: 25%;
		padding: 13px 0px 0px 0px;
		position: relative;
		float: left;
		box-sizing: border-box;
	}
	
	.aui-palace-grid-icon {
		width: 30px;
		height: 30px;
		margin: 0 auto;
		text-align: center;
		color: #fff;
	}
	
	.aui-palace-grid-icon image {
		display: block;
		width: 100%;
		height: 100%;
		border: none;
	}
	
	.aui-palace-grid-text {
		display: block;
		text-align: center;
		color: #333333;
		font-size: 13px;
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
		padding-top: 8px;
	}
	
	.aui-palace-grid-text-h2 {
		font-size: 0.75rem;
		font-weight: normal;
		color: #fff;
	}
	
	.aui-well-item {
		padding: 10px;
		position: relative;
		display: flex;
		-webkit-box-align: center;
		align-items: center;
	}
	
	.aui-well-item-hd {
		width: 23px;
		height: 23px;
		line-height: 23px;
		margin-right: 1em;
		text-align: center;
	}
	
	.aui-well-item-hd image {
		width: 100%; 
		max-height: 100%;
		vertical-align: top;
		display: block;
		border: none;
	}
	
	.aui-well-item-bd-x {
		-webkit-box-flex: 1;
		flex: 1;
		min-width: 0;
	}
	
	.aui-well-item-bd-x-h {color: #494949;}
	
	.aui-well-item-fr-jiao {
		font-size: 0.85rem;
		text-align: right;
		color: #a36c3b;
		padding-right: 20px;
		position: relative;
	}
	
	.hengx {position: absolute;bottom: 0;width: 90%;height: 1px;border-bottom: 1px solid #e4e5ea;left: 20px;}
	
	.aui-well-item-hd-w {
		width: 30%;
		height: 35px;
		line-height: 35px;
		margin-right: 1em;
		text-align: right;
		margin-right: 10px;
		color: #9CA0B8;
	}
	
	.aui-palace {
		padding: 5px 0px;
		position: relative;
		overflow: hidden;
	}
	button{padding: 0;margin: 0;background-color:#fff;text-align: left;}
	button::after{ border: none; }
	.button-hover {color:rgba(0, 0, 0, 0.6);}
	/* 水波纹 */
	.gif-wave {
		position: absolute;
		width: 100%;
		bottom: 0;
		left: 0;
		z-index: 99;
		mix-blend-mode: screen;
		height: 120rpx;
	}
	.aui-panel-cell-fr {text-align: right;font-size: 0.7rem;padding-right: 10px;color: #ffffff;width: 70px;}
	.tba{height:9px;width:65px;position: absolute;margin-top: 5px;left: 10px;height: 1.5rem;line-height: 1.5rem;background-color:#ff700a;color: #fff;text-align: right;font-size: .8rem;border-radius:60px;padding-right:10px ;}
</style>
