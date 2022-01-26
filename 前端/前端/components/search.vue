<template>
	<view class="overfor-x">
		<!-- 搜索框 -->
		<view class="container">
			<uni-search-bar radius="10" placeholder="搜索一下，爱上这个世界" @confirm="search" />
		</view>
		<!-- 标签-->
		<view class="swiper-list">
			<scroll-view class="" scroll-x="true">
				<view class="label-list" v-for="(antag,index) in searchTag" :key="index" @tap="tapTagHead(antag.id)">
					{{ antag.name }}
				</view>
			</scroll-view>
		</view>


		<!-- 判断微信流量主 -->
		<!-- #ifdef MP-WEIXIN -->
		<block v-if="adLsit.length>0">
			<!-- 唠叨一会 -->
			<view class="titel-h">
				猜你想玩
			</view>
			<view class="" style="margin: 0upx 30upx;">
				<ad :unit-id="adLsit[5].adid" ad-type="grid" grid-opacity="0.8" grid-count="5" ad-theme="white"></ad>
			</view>
		</block>
		<!-- #endif -->

		<!-- 判断QQ流量主 -->
		<!-- #ifdef MP-QQ -->
		<block v-if="QQadLsit.length>0">
			<!-- 唠叨一会 -->
			<view class="titel-h">
				猜你想玩
			</view>
			<ad :unit-id="QQadLsit[3].adid" type="block" block-orientation="landscape" block-size="5"></ad>
		</block>
		<!-- #endif -->



		<!-- 猜你想搜 -->
		<view class="titel-h">
			热门标签文章
		</view>
		<!-- 列表 -->
		<block v-for="(item ,index) in hotTagList" :key="item.id">
			<view class="list-li" @tap="tapTagList(item.id)" v-if="is_list">
				<view class="list-img">
					<image class="fengrui-img" :src="item.thumbnailurl" mode="aspectFill"></image>
				</view>
				<view class="list-li-left">
					<view class="list-li-left-h">
						{{ item.title.rendered }}
					</view>
					<view class="list-li-tag">
						权限：{{ item.comment_status }}
					</view>
					<view class="list-li-left-describe">
						<view class="">@{{ searchTag[0].name }}</view>
						<view>{{ item.date }}</view>
					</view>
				</view>
			</view>
		</block>
		<!-- 没有内容 -->
		<view class="no-datalist" v-if="is_data">
			<view class="no-img">
				<image class="fengrui-img" src="../../static/data/data-no.svg" mode=""></image>
			</view>
			<view class="no-text">
				热门标签内容为空！！！赶紧搜起来......
			</view>
		</view>
	</view>
</template>

<script>
	// 引入域名和自定义php文件
	import {
		API
	} from '@/components/api.js';
	import {
		Getresources
	} from '@/components/api.js';
	export default {
		data() {
			return {
				is_list: true,
				is_data: false,
				searchTag: [{
					id: 1,
					name: '数据加载中'
				}],
				hotTagList: [],
				frisTag: '',
				adLsit: [],
				QQadLsit: [],
				// 数据缓存
				totalte_sources: [],
				// 限制分类id
				exclude:'',
			}
		},
		onLoad() {
			// 自定义php接口请求
			this.Getres();

			// 微信分享盆友圈
			//#ifdef MP-WEIXIN
			wx.showShareMenu({
				withShareTicket: true,
				menus: ['shareAppMessage', 'shareTimeline']
			});

			//#endif

			//条件编译 QQ小程序分享
			//#ifdef MP-QQ
			qq.showShareMenu({
				showShareItems: ['qq', 'qzone', 'wechatFriends', 'wechatMoment']
			})
			//#endif

			// 获取格子广告
			// this.adMainflow();

		},

		// 分享好友配置
		onShareAppMessage(res) {
			var that = this;
			if (res.from === 'button') { // 来自页面内分享按钮
				console.log(res.target)
			}
			return {
				title: that.XcxMessage[0].title + '的搜索界面',
				imageUrl: that.XcxMessage[0].imageUrl,
			}
		},

		methods: {
			// 自定义php接口请求
			Getres: function() {
				var that = this;
				uni.request({
					url: Getresources,
					success: (res) => {
						that.totalte_sources = res.data;
						// 获取广告
						that.adLsit = res.data[3];
						that.QQadLsit = res.data[7];
						// 好友分享数据
						that.XcxMessage = res.data[11]
						// 限制分类id
						that.exclude = res.data[14][0];
						// 获取首页第一个文章
						this.posOnew();
						
						uni.setStorageSync("totalte_sources_key", that.totalte_sources);
					}
				});
			},

			// 列表点击跳转
			tapTagList: function(e) {
				var that = this;
				var posId = e;
				uni.navigateTo({
					url: '../data/data?id=' + posId,
				})
			},

			// 获取首页第一个文章
			posOnew: function() {
				var that = this;
				uni.request({
					url: API + '/wp-json/wp/v2/posts?categories_exclude=' + that.exclude.id,
					success: (res) => {
						that.frisTag = res.data[0].id;
						uni.setStorageSync("onePostTagID_key", that.frisTag);
						// 获取列表
						this.posTagList();
					}
				});
			},

			// 获取标签和文章
			posTagList: function() {
				var that = this;
				var posTagID = uni.getStorageSync('onePostTagID_key');
				uni.request({
					url: API + '/wp-json/wp/v2/tags?post=' + posTagID,
					success: (res) => {
						this.searchTag = res.data;
						this.onePosTag = res.data[0].id;
						uni.request({
							url: API + '/wp-json/wp/v2/posts?tags=' + this.onePosTag,
							success: (res) => {
								if (res.data.length == '') {
									that.is_data = true;
									that.is_list = false;
								} else {
									that.is_data = false;
									that.is_list = true;
									that.hotTagList = res.data.slice(0,6);
								}
							}
						});
					}
				});
			},

			// 搜索触发
			search: function(e) {
				var json = e.value;
				if (json == '') {
					uni.showToast({
						title: '请输入内容',
						mask: true,
						icon: 'success',
						duration: 1500
					});
				} else {
					uni.navigateTo({
						url: '../category/categ_lisst?keyword=' + json,
					})
				}
			},

			// 点击标签搜索
			tapTagHead: function(e) {
				var that = this;
				var jstag = e;
				uni.navigateTo({
					url: '../category/categ_lisst?jstag=' + jstag
				})
			},
		}
	}
</script>

<style>
	/* 没有数据时候 */
	.no-text {
		color: #e6e6e6;
		text-align: center;
		font-size: 24upx;
	}

	.no-img {
		margin: auto;
		height: 400upx;
		width: 400upx;
	}

	.no-datalist {
		margin: auto;
		overflow: hidden;
		margin-bottom: 60upx;
	}

	/* 列表 */
	.list-li-left-describe {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
		color: #D5D5D5;
		font-size: 20upx;
		display: flex;
		justify-content: space-between;
	}

	.list-li-tag {
		color: #0BBDA6;
		font-size: 20upx;
	}

	.list-li-left-h {

		font-size: 26upx;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
	}

	.list-li-left {
		margin-left: 32upx;
		flex-grow: 1;
		height: 120upx;
		display: flex;
		flex-flow: column;
		justify-content: space-between;
	}

	.list-img {
		height: 120upx;
		width: 140upx;
		border-radius: 14upx;
		overflow: hidden;
		flex-shrink: 0;
	}

	.list-li {
		display: flex;
		margin: 20upx 30upx;
		align-items: center;
		background-color: #fff;
		padding: 24upx;
		border-radius: 20upx;
	}

	/* 标题 */
	.title-h-ad {
		height: 240upx;
		border-radius: 16upx;
		margin: 48upx;
		overflow: hidden;
	}

	.titel-h {
		font-size: 28upx;
		margin: 38upx 30upx;
	}

	/* 标签 */
	.swiper-list {
		margin: 20upx 30upx 0upx 30upx;
		white-space: nowrap;
		width: 100%;
	}

	.label-list {
		height: 40upx;
		padding: 4upx 20upx;
		background: linear-gradient(90deg, rgba(67, 130, 235, 1) 0%, rgba(6, 189, 254, 1) 100%);
		border-radius: 100upx;
		margin-right: 40upx;
		color: #FFFFFF;
		font-size: 28upx;
		flex-shrink: 0;
		display: inline-block;
	}
	.container {
		/* margin: 0upx 40upx; */
		/* background-color: #FFFFFF; */
		/* border-radius: 20upx; */
	}

	.fengrui-img {
		height: 100%;
		width: 100%;
	}
	.overfor-x{
		overflow-x: hidden;
	}

	page {
		background-color: #F7F7F7;
		overflow-x: hidden;
	}

	/* 暗黑模式下应用的样式 */
	@media (prefers-color-scheme: dark) {
		page {
			background: #161616;
		}
		.list-li{
			background: #202020;
		}
		.uni-searchbar__box {
			border-color: #202020;
		
		}
	}
</style>
