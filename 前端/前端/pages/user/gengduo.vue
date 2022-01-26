<template>
	<view class="">

		<view  style="width: 100%;position: relative;overflow: hidden;padding: 20upx 48upx 14upx 28upx;">
			<view style="background: #fff;border-radius: 6px;padding-bottom: 5px;">




		<view style="margin:8px;" v-for="(item,index) in gameList" :key="index" >
		<view class="aui-flex">
			<view class="aui-logo-tag">
						<image :src="item.picname" alt="" style=" width: 55px;height: 55px;display: block;border-radius: 50px;">
			</view>
			<view class="aui-flex-box">
				<view class="" style="color: #000;margin-bottom: 0.5rem;font-size: 1rem;font-weight: bold">
					{{item.title}}
				</view>
				<view class="" style="color: #B2B2B2;font-size: 0.85rem;width: auto;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;word-wrap: normal;word-wrap: break-word;word-break: break-all;">
					{{item.content}}
				</view>
			</view>
			<view class="aui-button-go" @click="openLink(item.appid,item.link)">
				<button style="background: none;background-color: #5FB257;  border-radius: 6px;color: #fff;padding: 0rem 0.65rem;font-size: 0.75rem;" >进入</button>
			</view>
		</view>
		</view>
		
		
		
		
		</view>
		</view>
		
		
		<view  style="    width: 100%;position: relative;overflow: hidden;padding: 0 15px; padding-top: 10px;" v-if="faxians!=2">
			<view style="border-radius: 12px;padding-bottom: 5px;">
		<ad  v-if="gezi!=0" :unit-id="gezi" ad-type="grid" grid-opacity="0.8" grid-count="5" ad-theme="white"></ad>
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
			gameList:'',
			hasLogin: false,
			userjifen:'',
			userimg:'',
			usernc:'',
			jinbi:'',
			gezi:'',
			faxians:''
	    }
	},
	onShow(e){ 
		this.selectList();
		var _self = this;
		_self.$uniApi.checkPhone("");
		this.gezi =uni.getStorageSync('gezi');
		this.jinbi =uni.getStorageSync('jinbi');
		this.faxians =uni.getStorageSync('faxians');
		this.CreateAd();
	},onLoad(){
		this.selectList();
		var _self = this;
		_self.$uniApi.checkPhone("");
		this.shipin =uni.getStorageSync('shipin');
		this.jinbi =uni.getStorageSync('jinbi');
		this.faxians =uni.getStorageSync('faxians');
		this.CreateAd();
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
		},
			selectList(){
				uni.request({
					url: this.$serverUrl + '/App/zm/link',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {},
					success: (ret) => {
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret) {
							// 取数据并赋值
							this.gameList = ret.data.msg;
							//console.log(JSON.stringify(ret.data));
							
						} else {
							console.log('未取得数据');
						}
						uni.stopPullDownRefresh();
					}
				});
			},openLink(appid,link){
				uni.navigateToMiniProgram({
				  appId:appid,
				  path: '',
				  extraData: {
				    'data1': 'test'
				  },
				  success(res) {
				    // 打开成功
				  }
				}) 
			},openLogin(){
				uni.navigateTo({
					url: '/pages/login/login'
				});
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
/* 	page{background-color: #F1F1F1;} */
	page {
		background-color: #F7F7F7;
	}
	.aui-flex {
	    display: -webkit-box;
	    display: -webkit-flex;
	    display: flex;
	    -webkit-box-align: center;
	    -webkit-align-items: center;
	    align-items: center;
	    padding: 10px;
	    position: relative;
		background-color: #fff;
		border-radius: 5px;
	}
	.aui-logo-tag {
	    width: 55px;
	    height: 55px;
	    margin-right: 0.8rem;
	}
	.aui-flex-box {
	    -webkit-box-flex: 1;
	    -webkit-flex: 1;
	    flex: 1;
	    min-width: 0;
	    font-size: 14px;
	    color: #333;
	}
	.title {width: 100%;display: flex;justify-content: space-between;}
	.qiandao-1{text-align: center;width:10%;font-size: 9px;color:#fff;margin: 0 auto;float: left;margin: 7px;height:25px;}
	.qiandao-2{color:#fff;width:20px;height:20px;background-color: #007AFF;border-radius:100px;line-height: 20px;margin-left: 6px;font-size:10px;}
	.qiandao-3{margin-top:3px;font-size: 9px;color:#000;}
	
	.tb{height:9px;width:65px;position: absolute;margin-top: -9px;right: 12px;height: 1.5rem;line-height: 1.5rem;background-color:#B79A7A;color: #fff;text-align: right;font-size: .8rem;border-radius:60px;padding-right:10px ;}
	.aui-panel{padding: 20px 10px 0px 10px;position: relative;margin-bottom: 10px;}
	.aui-panel-cell {display: flex;-webkit-box-align: center;align-items: center;color: #333333;-webkit-tap-highlight-color: rgba(0, 0, 0, 0);position: relative;}
	.aui-panel-cell-hd {margin-right: 1em;width:55px;height:55px;line-height: 70px;text-align: center;}
	.aui-panel-cell-hd image {width: 100%;max-height: 100%;vertical-align: top;display: block;border: none;border-radius: 100%;}
	.aui-panel-cell-bd {-webkit-box-flex: 1;flex: 1;min-width: 0;}
	.aui-panel-cell-bd-h4 {font-weight: 400;font-size: 16px;width: auto;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;word-wrap: normal;word-wrap: break-word;word-break: break-all;color: #000000;}
	.title-t{font-style: normal;float: left;color:#000;}
	.title-tu{display: block;float: left;margin-left: 10px;}
	.title-vip{width: 55px;display: block;border: none;float: left;height:20px;}
	.title-id{color:#9CA0B8;font-size: 12px;}
	.aui-panel-cell-fr {text-align: right;font-size: 0.7rem;padding-right: 10px;color: #ffffff;width: 70px;}
</style>
