<template>
	<view class="body">
		<!-- 轮播图-->
		<swiper indicator-active-color="#FFFFFF" :indicator-dots="true" :autoplay="true" :interval="3000" :duration="1000"
		 class="swiper-box">
			<swiper-item v-for="(list,index) in lunboList" :key="index" @click="openLink(list.link)">
				<view class="swiper-item">
					<image class="lunbo-box" :src="list.picname" mode="" style="width:100%;margin-bottom:0px"></image>
				</view>
			</swiper-item>

		</swiper>

		
		<view class="notice-flex" v-if="notice!=2">
			<view class="notice-img">
				<image class="fengrui-img" src="../../static/image/notice.png" mode=""></image>
			</view>
			<uni-notice-bar class="notice-fr-title" scrollable="true" :color="color" single="true" :speed="speed" :text="gonggao"></uni-notice-bar>
		</view>





		<!-- 分类 -->
		<view class="main" style="">
			<view class="liebiao">
				
				<view class="liebiao-li" @click="openSou()">
					<image class="liebiao-img" src="../../static/image/sou.png">
						<i class="liebiao-i">搜索</i>
				</view>
				<view class="liebiao-li" @click="openType('list','hot')">
					<image class="liebiao-img" src="../../static/image/hot.png">
						<i class="liebiao-i">热门</i>
				</view>
				<view class="liebiao-li" @click="openType('index','tags')">
					<image class="liebiao-img" src="../../static/image/xx.png">
						<i class="liebiao-i">星球</i>
				</view>
				<view class="liebiao-li" @click="openType('list','vip')">
					<image class="liebiao-img" src="../../static/image/vip.png">
						<i class="liebiao-i">VIP</i>
				</view>

				<view class="liebiao-li" @click="openType('list','all')">
					<image class="liebiao-img" src="../../static/image/all.png">
						<i class="liebiao-i">全部</i>
				</view>
			</view>
		</view>


		<!-- 焦点标题 -->
		<view class="titel-vi">
			<view class="titel-vi-q">
				<view class="titel-vi-img">
					<image class="fengrui-img" src="../../static/image/zuixin.png"></image>
				</view>
				<view class="titel-vi-font">最新文章</view>
			</view>
			<view class="titel-vi-right" @click="openType('list','all')">
				查看更多
			</view>
		</view>

		<view class="postlist-bg">
			<block v-for="(item,index) in indexList" :key="index">
				<view class="menu-scroll-list" @click="openWin(item.id,item.title)">
					<view class="menu-scroll-list-img">


						<image class="fengrui-img" :src="item.picname"></image>

					</view>
					<view class="menu-scroll-list-right">
						<view class="menu-scroll-list-h">
							{{ item.title}}
						</view>
						<view class="list-li-tag" v-if="item.type==1 || item.type==2 || item.type==5">
							权限：免费
						</view>
						<view class="list-li-tag" v-if="item.type==3">
							权限：VIP专享
						</view>
						<view class="list-li-tag" v-if="item.type==4">
							积分：{{item.price}}
						</view>
						<view class="menu-scroll-list-describe">
							<!-- <view class="">@{{ searchTag[0].name }}</view> -->
							<view style="font-size: 10px;">{{item.addtime | timeStamp}}</view>
						</view>
					</view>
				</view>
				<!-- #ifdef MP-WEIXIN -->
				<view v-if="indexb!=2">
					<block v-if="index%8==7">
						<view style="margin: 0upx 20upx;">
							<ad v-if="banner!=0" :unit-id="banner" class="lunbo-box"> </ad>
						</view>
					</block>
				</view>
				<!-- #endif -->


			</block>
			<view class="load-more" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">
				{{load}}
			</view>
		</view>

		<view style="padding-bottom: 50px;width:100%;height:10px;"></view>


		<add-tip :tip="tip" :duration="duration" />

	</view>
</template>

<script>
	import addTip from '@/components/struggler-uniapp-add-tip/struggler-uniapp-add-tip.vue'
	import uniNoticeBar from '@/components/uni-notice-bar/uni-notice-bar.vue';
	export default {
		components: {
			uniNoticeBar,
			addTip
		},
		data() {
			return {
				lunboList: [],
				indexList: '',
				noticeList: '',
				souvalue: '',
				notice: '',
				scout: '',
				tip: "点击「添加到我的小程序」，下次访问更便捷",
				duration: 5,
				banner: '',
				shipin: "",
				gezi: 2,
				indexb: '',
				indexg: '',
				indexs: '',
				speed: 50,
				color: '#807C7C',
				load: "上拉加载更多",
				page: 0,
				gonggao: ''
			}
		},
		//发送到朋友圈
		onShareTimeline(res) {
			let title = uni.getStorageSync('appname');
			return {
				title: title, //字符串 自定义标题
				//imageUrl: "https://acg.qcair.cc/loli97/acg/api_acg.php" //图片地址
			}
		},
		//转发
		onShareAppMessage: function(e) {
			let title = uni.getStorageSync('appname');
			return {
				title: title,
				path: 'pages/index/index'
			}
		},
		filters: {
			timeStamp: function(value) {
				if (!value) return '';
				var now = new Date(value * 1000);
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
		onReachBottom() {
			this.page = this.page + 10;
			console.log(this.page);
			//	console.log(this.type);
			if (this.load != "上拉加载更多") {
				return;
			}
			this.load = "加载中...";
			setTimeout(() => {
				uni.request({
					url: this.$serverUrl + '/App/zm/all',
					header: {
						'content-type': 'application/x-www-form-urlencoded',
					},
					method: 'POST',
					data: {
						nextrow: this.page
					},
					success: (ret) => {
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}

						if (ret) {
							if (ret.data.code == 1) {
								// 取数据并赋值
								this.indexList2 = ret.data.msg;
								this.indexList.push(...this.indexList2);

								this.load = "上拉加载更多";
							} else {

								this.load = "~~·我是有底线的人·~~";
							}
						}
						uni.stopPullDownRefresh();
					}
				});
			}, 2000);
		},
		onLoad() {
			uni.showLoading({
				title: '加载中',
				mask: true
			});
			setTimeout(() => {
				uni.hideLoading()
			}, 1000)
			this.selectLunbo();
			this.selectIndextype();
			this.noticelist();
			var tanstatus = uni.getStorageSync('tanstatus');
			if(tanstatus==1){
				this.tan();
			}
			
			var _self = this;
			_self.$uniApi.checkPhone("123123");
			this.scout = uni.getStorageSync('scout');
			this.notice = uni.getStorageSync('notice');
			var title = uni.getStorageSync('appname');
			uni.setNavigationBarTitle({
				title: title
			})
			this.banner = uni.getStorageSync('banner');
			// this.gezi = uni.getStorageSync('gezi');
			// this.shipin = uni.getStorageSync('shipin');
			this.indexb = uni.getStorageSync('indexb');
			this.gonggao = uni.getStorageSync('gonggao');
			// this.indexs = uni.getStorageSync('indexs');
		},
		methods: {
			tan(){
				uni.showModal({
					title: uni.getStorageSync('title'),
					content: uni.getStorageSync('nei'),
					confirmColor:'#FF4400',
					showCancel:false,
					
					success: function(res) {
						if (res.confirm) {
				
						}
					}
				});
			},
			selectLunbo() { // 取轮播图数据
				uni.request({
					url: this.$serverUrl + '/App/Zm/lunbo',
					success: (ret) => {
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret) {
							// 取数据并赋值
							this.lunboList = ret.data.slun;

							//console.log(JSON.stringify(ret.data));
						} else {
							this.lunboList = '';
						}
						uni.stopPullDownRefresh();
					}
				});

			},
			selectIndextype() { // 取视频数据
				uni.request({
					url: this.$serverUrl + '/App/zm/all',
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
							if (ret.data.code == 1) {
								// 取数据并赋值
								this.indexList = ret.data.msg;
								this.wu = false;
							} else if (ret.data.code == 0) {
								this.indexList = '';
								this.load = "~~·我是有底线的人·~~";

							}
						}


						uni.stopPullDownRefresh();
					}
				});
			},
			noticelist() { // 取视频数据
				uni.request({
					url: this.$serverUrl + '/App/Zm/notice',
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
							this.noticeList = ret.data.msg;
							//console.log(JSON.stringify(ret.data));

						} else {
							console.log('未取得数据');
						}
						uni.stopPullDownRefresh();
					}
				});
			},
			openWin(tid, title) {
				uni.navigateTo({
					url: '/pages/details/details?tid=' + tid + '&title=' + title
				});
			},
			openType(type, list) {
				uni.navigateTo({
					url: '/pages/' + type + '/' + list
				});
			},
			openNotice(tid) {
				uni.navigateTo({
					url: '/pages/index/notice?tid=' + tid
				});
			},
			sou() {
				var souvalue = this.souvalue;
				if (!souvalue) {
					uni.showToast({
						title: '搜索关键字不能为空',
						icon: 'none'
					});
					return
				}
				uni.navigateTo({
					url: '/pages/index/scout?keyword=' + souvalue
				});
			},
			shua(tid) {
				uni.navigateTo({
					url: '/pages/type/list?tid=' + tid
				});
			},
			openLink(link) {
				uni.navigateTo({
					url: link
				});
			},
			openSou() {
				uni.switchTab({
					url: "../faxian/faxian"
				})
			}
		}
	}
</script>

<style>
	.title {
		width: 100%;
		display: flex;
		justify-content: space-between;
	}

	page {
		background-color: #F7F7F7;
	}

	/* 公告 */
	.notice-flex {
		display: flex;
		height: 90upx;
		margin: 0upx 20upx;
		border-top: #F5F5F5 1px solid;
		background-color: #FFFFFF;
		padding: 20upx 48upx 14upx 28upx;
		border-radius: 20upx;
		margin-bottom: 12px;
		margin-top: 5px;
	}

	.notice-img {
		height: 30upx;
		width: 140upx;
		flex-fhrink: 0;
		margin-top: 8upx;
	}

	.notice-fr-title {
		width: calc(100% - 140upx);

	}

	.fengrui-img {
		width: 100%;
		height: 100%;
	}

	/**轮播图**/
	.lunbo-box {
		width: 100%;
		height: 100%;
	}

	/* 轮播图 */
	.swiper-item {
		border-radius: 16upx;
		overflow: hidden;
		height: 320upx;
	}

	.swiper-box {
		height: 340upx;
		border-radius: 16upx;
		overflow: hidden;
		padding: 5px 10px 5px 10px;
	}

	.liebiao {
		display: flex;
		flex-wrap: wrap;
		justify-content: flex-start;
		margin-top: 0.2rem;
		background-color: #FFFFFF;
		margin: 0upx 20upx;
		padding: 10upx 10upx 10upx 10upx;
		border-radius: 20upx;
	}

	.liebiao-li {
		width: 20%;
		height: 5rem;
		display: flex;
		text-align: center;
		justify-content: center;
		flex-direction: column;
		padding: 0.2rem 0px;
	}

	.liebiao-img {
		width: 40px;
		height: 45px;
		margin: 0.2rem auto;
		border-radius: 50%;
	}

	.liebiao-i {
		font-style: normal;
		color: #656565;
		padding: 0.2rem 0px;
		font-size: 0.8rem;
	}

	.uni-swiper-msg {
		height: 40px;
	}

	.uni-swiper-msg {
		height: 40px;
	}

	.divHeight {
		width: 100%;
		height: 10px;
		background: #f5f5f5;
		position: relative;
		overflow: hidden;
	}

	.aui-flex {
		display: flex;
		-webkit-box-align: center;
		align-items: center;
		padding: 0px 10px 5px 7px;
		position: relative;
	}


	.aui-flex-box {
		-webkit-box-flex: 1;
		flex: 1;
		min-width: 0;
		font-size: 14px;
		color: #333;
	}

	.h2 {
		font-size: 0.9rem;
		color: #323232;
		margin-bottom: 0.9rem;
	}

	.index-search {
		position: relative;
		border-radius: 4px;
		padding: 4px 3px;
		/* background: #f5f5f5; */
	}

	.index-header-search {
		margin: 0 auto;
		background-color: #ffffff;
		width: 100%;
	}

	.search_box {
		width: 77%;
		height: 60upx;
		background: #ffffff;
		border-radius: 4px;
		border: 1px #dedede solid;
		display: flex;
		align-items: center;
		padding: 0upx 40upx;
	}

	.article_div {
		background-color: white;
		border-top: 1px solid #f1f0f5;
	}

/* 	.icon_new {
		width: 52px;
		height: 40px;
		border-right: 1px solid #f1f0f5;
		background: url(../../static/image/gong.png);
		background-position: center center;
		background-repeat: no-repeat;
		background-size: 20px auto;
	} */

	.article_div_list {
		margin: 0 8px;
		height: 40px;
		overflow: hidden;
		position: relative;
	}

	.article_div_list_li {
		display: block;
		width: 100%;
		height: 40px;
		line-height: 43px;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		color: #494949;
		font-size: 14px;
		position: absolute;
	}

	/* 资源 */
	.aui-list-theme-box {
		padding: 10px 0 0 1rem;
		overflow: hidden;
		position: relative;
	}

	.aui-list-item {
		width: 46%;
		float: left;
		margin: 0 4% 2% 0;
		background: #fff;
		display: block;
		overflow: hidden;
	}

	.aui-list-theme-img {
		height: 120px;
		width: 100%;
		position: relative;
	}

	.aui-list-theme-message {
		background: #fff;
		padding: 0.3rem 0;
	}

	.aui-list-theme-title {
		color: #333;
		font-size: 0.92rem;
		margin: 0.2rem 0;
		overflow: hidden;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		word-break: break-all;
		font-weight: normal;
		text-overflow: ellipsis;
	}

	.ico_common {
		display: block;
		position: absolute;
		right: 0;
		top: 0;
		width: 40px;
		height: 40px;
		background-repeat: no-repeat;
		background-position: center center;
		background-size: 100%;
		background-image: url(../../static/image/hot.png);
	}

	.learned {
		display: inline-block;
		background-color: rgba(0, 0, 0, 0.5);
		padding: 3px 6px;
		font-size: 10px;
		position: absolute;
		color: white;
		font-weight: normal;
		bottom: 1px;
		right: 1px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}

	.ad {
		height: 200px;
	}

	/* 标题 */
	.titel-vi-right {
		color: #989898;
		height: 80upx;
		line-height: 80upx;
		font-size: 20upx;
	}

	.titel-vi-font {
		font-size: 30upx;
		margin-left: 24upx;
	}

	.titel-vi-img {
		width: 36upx;
		height: 36upx;
	}

	.titel-vi {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin: 28upx 30upx 20upx 30upx;
	}

	.titel-vi-q {
		display: flex;
		justify-content: flex-start;
		align-items: center;
	}


	.postlist-bg {
		background-color: #FFFFFF;
		border-radius: 30upx;
		overflow: hidden;
		margin: 20upx;

	}

	/* 内容数据 */
	.menu-scroll-list-describe {
		color: #ADADAD;
		font-size: 20upx;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
	}

	.list-li-tag {
		color: #0BBDA6;
		font-size: 20upx;
	}

	.menu-scroll-list-h {
		font-size: 28upx;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}

	.menu-scroll-list-right {
		margin-left: 32upx;
		width: 420upx;
		display: flex;
		justify-content: space-between;
		flex-flow: column;
	}

	.menu-scroll-list-img {
		width: 360upx;
		height: 160upx;
		border-radius: 16upx;
		overflow: hidden;
	}

	.menu-scroll-list {
		display: flex;
		margin: 20upx 20upx;
	}
</style>
