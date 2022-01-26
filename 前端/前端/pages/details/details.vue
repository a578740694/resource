<template>
	<view class="scrool-page">
		<view class="d-flex a-center "></view>
		<view class="list-cont">
			<scroll-view class="scrool-more" style="height: 100%" scroll-y="true" scroll-with-animation="true">
				<view class="" style="width:100%; height:180px;background-repeat:no-repeat;background-position:center center;background-size: 100% 100%;"
				 :style="{backgroundImage: 'url(' + info.picname + ')'}">

				</view>

				<view class="" style="width:100%;height:auto;border-top:1px solid #CCCCCC;margin-top:-20%;border-radius:35px 35px 0px 0px;background-color: #fff;min-height:440px;">
					<view style="padding: 10px 20px 0px 25px;font-weight: 700;font-size: 18px;">{{info.title}}</view>
					<view style="padding: 0px 15px 0px 15px;">
						<view class="" style="border-top:1px dashed #000"></view>
						<view class="guanggao" style="width:100%;margin-top:3px;transform:scale(0.999417);height: auto !important;" v-if="detab!=2">
<ad v-if="banner!=0" :unit-id="banner" class="lunbo-box"> </ad>
						</view>
					</view>
					<view class="textnei" :class="isFload ? 'hidea' : 'showa'">

						<rich-text type="text"  selectable="true"  :nodes="demoHtml"></rich-text>
 

					</view>
					
					
					
				<button type="default" style="background:#F19E38;align-content: center;width:30%;font-size: 13px;color:#fff;margin-top:5px;" @click="openJi(info.id,info.title,info.picname)" v-if="yue">点击阅读全文</button>
				
					
				</view>
<view style="width: 100%;padding: 0 15px; " v-if="detas!=2">
		<ad v-if="shipin!=0" :unit-id="shipin" ad-type="video" ad-theme="white"></ad>
		</view>
				<!-- 分类 -->
				<view class="main" style="">
					<view class="liebiao">
						<view class="liebiao-li" @click="openWin('vip')">
							<image class="liebiao-img" src="../../static/image/all.png">
								<i class="liebiao-i">升级会员</i>
						</view>
						
						<view class="liebiao-li" @click="openWin('faq')">
							<image class="liebiao-img" src="../../static/image/zuixin.png">
								<i class="liebiao-i">使用说明</i>
						</view>
						
					
				<button open-type='contact' session-from='' hover-class='none' class="lianv">
							<image class="liebiao-img" src="../../static/image/remen.png">
						<i class="liebiao-i">连接失效</i>
							</button>		
					
							
						<view class="liebiao-li" @click="previewImg()">
							<image class="liebiao-img" src="../../static/image/vip.png">
								<i class="liebiao-i">赞赏</i>
						</view>
						<view class="liebiao-li" @click="openWin('about')">
							<image class="liebiao-img" src="../../static/image/remen.png">
								<i class="liebiao-i">关于我们</i>
						</view>

					</view>
				</view>

				<view class="" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">本站资源均源自网络，如果有问题请联系客服我们将在72小时内删除</view>
			</scroll-view>

		</view>
		
		<!-- 导航 -->
		<view class="footer">
			
				<navigator open-type="navigateBack" class="gohome">
				<image style="width: 20px;height: 20px;"  src="../../static/image/sy.png">
				<view class="" style="color: rgba(41, 43, 51, 0.4);font-size: 10px;line-height: 18px;">
					首页
				</view>
				</navigator>
			
			<view class="gohome" @click="openShou(info.id,info.title,info.picname)">
				<image style="width: 20px;height: 20px;"  src="../../static/image/sc.png">
				<view class="" style="color: rgba(41, 43, 51, 0.4);font-size: 10px;line-height: 18px;">
					收藏
				</view>
			</view>
			
			<button class="district-fenrid" open-type="share">
				<image style="width: 20px;height: 20px;"  src="../../static/image/fx.png">
				<view class="" style="color: rgba(41, 43, 51, 0.4);font-size: 10px;line-height: 18px;">
						分享
				</view>
				
			</button>
		
			<!--  <view class="" style="background: #0486FE;color: #fff;-webkit-box-flex: 1;flex: 1 100%;">
			  	获取资源
			  </view> -->

			<view class="" style="color: #fff;-webkit-box-flex: 1;flex: 1 100%;background: #fff;" @click="openJi(info.id,info.title,info.picname)" v-if="dibu1">
				<button type="default" style="border-radius: 80rpx;font-size: 35rpx;width:80%;height: 40px;background: #F19E38;color:#fff;line-height: 40px;">获取资源</button>
			</view>
				
			<view class="" style="color: #fff;-webkit-box-flex: 1;flex: 1 100%;background: #fff;" @tap="openVip(info.id,info.title,info.picname)"  v-if="vipcha">
				<button type="default" style="border-radius: 80rpx;font-size: 35rpx;width:80%;height: 40px;background: #F19E38;color:#fff;line-height: 40px;">查看资源</button>
			</view>

			<view class="" style="color: #fff;-webkit-box-flex: 1;flex: 1 100%;background: #fff;" @click="openGoods(info.id,info.title,info.picname)" v-if="goods">
				<button type="default" style="border-radius: 80rpx;font-size: 35rpx;width:80%;height: 40px;background: #F19E38;color:#fff;line-height: 40px;">{{info.price}} 积分获取资源</button>
			</view>

			<view class="" style="color: #fff;-webkit-box-flex: 1;flex: 1 100%;background: #fff;" @tap="showModal" data-target="DialogModal1" v-if="mianfei">
				<button type="default" style="border-radius: 80rpx;font-size: 35rpx;width:80%;height: 40px;background: #F19E38;color:#fff;line-height: 40px;">查看资源</button>
			</view>
		</view>
		
		<!-- 弹窗 -->
		<view class="cu-modal DialogModal1 show" style="z-index: 580;" v-if="modalName">
			<view class="cu-dialog">
				<view class="cu-bar bg-white justify-end">
					<view class="content">资源地址</view>
					<view class="action" @tap="hideModal">
						<text class="cuIcon-close text-red"></text>
					</view>
				</view>
				<view style="padding: 5px;text-align: left;">
					{{info.dizhi}}
				</view>
				<view class="cu-bar bg-white justify-end">
					<view class="action">
						<button class="cu-btn line-green text-green" @tap="hideModal">取消</button>
						<button class="cu-btn bg-green margin-left" @click="copy(info.dizhi)">复制</button>

					</view>
				</view>
			</view>
		</view>
		<!-- 弹窗end -->
	</view>
</template>
<script>
	var graceRichText = require("../../components/richText.js");
	// 引入文件
	 import uniCopy from '@/js_sdk/xb-copy/uni-copy.js'
	 // 在页面中定义激励视频广告
	let rewardedVideoAd = null;
	// 在页面中定义激励视频广告
	let videoAd = null
	export default {
		data() {
			return {
				tid: '',
				info: '',
				demoHtml: '',
				isFload: true,
				dibu1:false,
				yue:false,
				vipcha:false,
				goods:false,
				mianfei:false,
				modalName: false,
				banner:'',
				shipin:"",
				detab:'',
				detas:''
			}
		},
		// 分享好友配置
		onShareAppMessage(res) {
			var that = this;
			if (res.from === 'button') { // 来自页面内分享按钮
				console.log(res.target)
			}
			return {
				title: that.info.title,
				imageUrl: that.info.picname,
				path: '/pages/details/details?tid=' + this.tid
			}
		},
		onShow(event) {
			var _self = this;
			_self.$uniApi.checkPhone("");
			_self.getlist();
		},
		onLoad(event) {
			this.tid = event.tid
			uni.setNavigationBarTitle({
				title: event.title
			})
			this.getlist();
			this.banner = uni.getStorageSync('banner');
			this.shipin =uni.getStorageSync('shipin');
			this.detab =uni.getStorageSync('detab');
			this.detas =uni.getStorageSync('detas');
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
							 uni.showToast({
							 	icon: 'none',
							 	title: "感谢您的支持"
							 })
							 this.modalName = true;
							 this.isFload = false;
							 this.yue = false;
						
							 this.openHuo(that.info.id,that.info.title,that.info.picname);
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
				
			},
			  copy(value) {
			            uniCopy({
			                content:value,
			                success:(res)=>{
			                    uni.showToast({
			                    	title: '复制成功！',
			                    	icon: 'none',
			                    	duration: 2000,
			                    });
			                }
			            })
			        },
			showModal() {
				this.modalName = true;
				
			},
			hideModal(e) {
				this.modalName = null
			},
			openYue(tid,title,picname) {
				this.isFload = false;
				this.yue = false;
				this.mianfei = true;
				this.openHuo(tid,title,picname);
			},
			getlist() {
				const user_id = uni.getStorageSync('user_id');
				uni.request({
					url: this.$serverUrl + '/App/zm/getlist',
					header: {
						'content-type': 'application/x-www-form-urlencoded',
					},
					method: 'POST',
					data: {
						tid: this.tid,
						uid:user_id
					},
					success: (ret) => {
						//console.log(JSON.stringify(ret.data.msg));
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret.data.code == 1) {
							this.info = ret.data.msg;
							if(ret.data.msg.buygoods ==null){
								if(ret.data.msg.type==1){
									this.isFload = false;
									this.dibu1 = true;
								}else if(ret.data.msg.type==2){
									this.dibu1 = false;
									this.yue = true;
								}else if(ret.data.msg.type==3){
									this.isFload = false;
									this.vipcha = true;
								}else if(ret.data.msg.type==4){
									this.isFload = false;
									this.goods = true;
								}else if(ret.data.msg.type==5){
									this.isFload = false;
									this.mianfei = true;
								}
							}else{
								this.isFload = false;
								this.dibu1 = false;
								this.goods = false;
								this.yue = false;
								this.vipcha = false;
								this.mianfei = true;
							}
							
							this.demoHtml = graceRichText.format(ret.data.msg.content);
						} else {

						}
					}
				});
			},
			openHuo(tid,title,picname) {
				const user_id = uni.getStorageSync('user_id');
				if (user_id) {
					uni.request({
						url: this.$serverUrl + '/App/Zm/huoqu',
						header: {
							'content-type': 'application/x-www-form-urlencoded',
						},
						method: 'POST',
						data: {
							tid: tid,
							uid: user_id,
							title: title,
							picname: picname
						},
						success: (ret) => {
							//console.log(JSON.stringify(ret.data.msg));
							if (ret.statusCode !== 200) {
								console.log('请求失败', ret);
								return;
							}
							if (ret.data.code == 1) {
								uni.setStorageSync('buy', ret.data.msg);
								this.$forceUpdate(this.getlist());
								uni.showToast({
									title: '获取成功！',
									icon: 'none',
									duration: 2000,
								});
							} else {
								uni.showToast({
									title: ret.data.msg,
									icon: 'none',
									duration: 2000,
								});
							}
						}
					});
				}

			},
			openShou(tid, title, picname) {
				const user_id = uni.getStorageSync('user_id');
				if (user_id) {
					uni.request({
						url: this.$serverUrl + '/App/zm/collect',
						header: {
							'content-type': 'application/x-www-form-urlencoded',
						},
						method: 'POST',
						data: {
							tid: tid,
							uid: user_id,
							title: title,
							picname: picname
						},
						success: (ret) => {
							//console.log(JSON.stringify(ret.data.msg));
							if (ret.statusCode !== 200) {
								console.log('请求失败', ret);
								return;
							}
							if (ret.data.code == 1) {
								uni.setStorageSync('collect', ret.data.msg);
								uni.showToast({
									title: '收藏成功！',
									icon: 'none',
									duration: 2000,
								});

							} else {
								uni.showToast({
									title: ret.data.msg,
									icon: 'none',
									duration: 2000,
								});
							}
						}
					});
				} else {
					uni.navigateTo({
						url: '/pages/login/login'
					});
				}

			},
			openIndex() {
				uni.navigateTo({
					url: '/pages/index/index'
				});
			},openJi() {
				const user_id = uni.getStorageSync('user_id');
				if (!user_id) {
					uni.navigateTo({
						url: '/pages/login/login'
					});
					return;
				}
				let that = this;
				uni.showModal({
					title: '提示',
					content: '观看一段广告,即可此获得资源',
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
				
				
				
				
			},openVip(tid,title,picname){
				const user_id = uni.getStorageSync('user_id');
				if (user_id) {
				var viptime = uni.getStorageSync('viptime');
				var nowTime = Date.parse(new Date())/1000;
				if (viptime>nowTime) {
					this.modalName = true;
					//this.openHuo(tid,title,picname);
				}else{
					uni.showToast({
						title: '您还不是VIP!',
						icon: 'none',
						duration: 2000,
					});
				}
				}else{
					uni.navigateTo({
						url: '/pages/login/login'
					}); 
				}
				
			},openGoods(tid,title,picname) {
				const user_id = uni.getStorageSync('user_id');
				if (user_id) {
					uni.request({
						url: this.$serverUrl + '/App/zm/goods',
						header: {
							'content-type': 'application/x-www-form-urlencoded',
						},
						method: 'POST',
						data: {
							tid: tid,
							uid: user_id,
							title: title,
							picname: picname
							
						},
						success: (ret) => {
							//console.log(JSON.stringify(ret.data.msg));
							if (ret.statusCode !== 200) {
								console.log('请求失败', ret);
								return;
							}
							if (ret.data.code == 1) {
								uni.setStorageSync('jifen', ret.data.msg.jifen);
								uni.setStorageSync('buy', ret.data.msg.buy);
								uni.showToast({
									title: '购买成功！',
									icon: 'none',
									duration: 2000,
								});
					this.modalName = true;
							} else {
								uni.showToast({
									title: ret.data.msg,
									icon: 'none',
									duration: 2000,
								});
							}
						}
					});
					
					
					
				}else{
					uni.navigateTo({
						url: '/pages/login/login'
					}); 
				}
				
			},// 预览图片单张
			previewImg() {
				let _this = this;
				let imgsArray = [];
				imgsArray[0] =  uni.getStorageSync('zanshang');
				uni.previewImage({
				current: 0,
				urls: imgsArray
				});
			},openWin(type){
				uni.navigateTo({
					url: '/pages/user/'+type+''
				}); 
			}
		}
	}
</script>

<style lang="less">
	page {
		background-color: #fff;
	}

	.scrool-page {
		display: flex;
		flex-direction: column;
		width: 100%;
		height: 100%;
	}

	.list-cont {
		flex: 1;
		position: relative;

		.scrool-more {
			position: absolute;
			left: 0;
			right: 0;
			top: 0;
			bottom: 0;
		}
	}

	.footer {
		bottom: 0;
		left: 0;
		z-index: 100;
		width: 100%;
		display: flex;
		-webkit-box-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		align-items: center;
		border-top: 1px solid #f6f6f6;
	}

	.gohome {
		-webkit-box-flex: 1;
		flex: 1 25%;
		background: #ffffff;
		display: flex;
		align-items: center;
		flex-direction: column;
		height: 50px;
		padding-top: 8px;
		margin-top: 2px;
	}

	.liebiao {
		display: flex;
		width: 100%;
		flex-wrap: wrap;
		justify-content: flex-start;
		margin-top: 0.2rem;
		/* background-color: #212429; */

	}

	.liebiao-li {
		width: 20%;
		height: 5rem;
		display: flex;
		text-align: center;
		justify-content: center;
		flex-direction: column;
		padding: 0.4rem 0px;
	}

	.liebiao-img {
		width: 25px;
		height: 25px;
		margin: 0.2rem auto;
		border-radius: 50%;
	}

	.liebiao-i {
		font-style: normal;
		color: rgba(41, 43, 51, 0.4);
		padding: 0.2rem 0px;
		font-size: 0.5rem;
	}

	.textnei {
		padding: 0px 15px 0px 15px;
		display: -webkit-box;
		word-break: break-all;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 3;
		overflow: hidden;
		text-overflow: ellipsis;
		background:#FAFAFA;
		opacity: 0.3;
	}
	.textnei1 {
		padding: 0px 15px 0px 15px;
	}
	.hidea {
		display: -webkit-box;
	}

	.showa {
		display: block;
		background:#FFFFFF;
		opacity:10;
	}
	.lianv{
		width: 20%;
		height: 5rem;
		display: flex;
		text-align: center;
		justify-content: center;
		flex-direction: column;
		padding: 0.4rem 0px;
		background-color: #fff;
	}
	.lianv::after{ border: none; }
	
	.district-fenrid{
		-webkit-box-flex: 1;
		flex: 1 25%;
		background: #ffffff;
		display: flex;
		align-items: center;
		flex-direction: column;
		height: 50px;
		padding-top: 8px;
		margin-top: 2px;
	background-color:#fff;
	}
	.district-fenrid::after{ border: none; }
</style>
