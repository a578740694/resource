<template>
	<view class="">
		
	
	<view class="tag-all">
	
		<view class="tag-view">
			<view class="tag-li"v-for="(item,index)  in resou" :key="index" @click="search(item)">
				<view class="tag-yuan" :style="{background:tag_color[index]}"></view>
				{{item}}
			</view>
		</view>
	
		<!-- 文章列表没有数据 -->
		
	</view>
	<view class="" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">~~·我是有底线的人·~~</view>
	</view>
</template>

<script>
	
	
	export default {
		data() {
			return {
				ss:'',
				aa: [],
				resou:[],
				gezi: 2,
				indexg: '',
				tag_color: [
					'#ff0000', '#eb4310', '#f6941d', '#fbb417', '#ffff00', '#cdd541', '#99cc33', '#3f9337', '#219167', '#239676',
					'#24998d', '#1f9baa', '#0080ff', '#3366cc', '#333399', '#003366', '#800080', '#a1488e', '#c71585', '#bd2158',
					'#871F78', '#8E236B', '#D9D9F3', '#00FF00', '#6B238E', '#32CD99', '#5959AB', '#0000FF', '#2F4F4F', '#3232CD', 
					'#6F4242', '#FF00FF', '#97694F', '#6B8E23', '#BC1717', '#00FFFF', '#7093DB', '#EAEAAE', '#238E68', '#FFFF00', 
					'#855E42', '#9370DB', '#6B4226', '#545454', '#426F42', '#8E6B23', '#70DB93', '#856363', '#7F00FF', '#E6E8FA',
					'#5C3317', '#D19275', '#7FFF00', '#3299CC', '#9F5F9F', '#8E2323', '#70DBDB', '#007FFF', '#B5A642', '#238E23', 
					'#DB7093', '#FF1CAE', '#D9D919', '#CD7F32', '#A68064', '#00FF7F', '#A67D3D', '#DBDB70', '#2F2F4F', '#236B8E',
					'#8C7853', '#C0C0C0', '#23238E', '#38B0DE', '#A67D3D', '#527F76', '#4D4DFF', '#DB9370', '#5F9F9F', '#93DB70', 
					'#FF6EC7', '#D8BFD8', '#D98719', '#215E21', '#00009C', '#ADEAEA', '#B87333', '#4E2F2F', '#EBC79E', '#5C4033',
					'#FF7F00', '#9F9F5F', '#CFB53B', '#CDCDCD', '#42426F', '#C0D9D9', '#FF7F00', '#5C4033', '#A8A8A8', '#FF2400', 
					'#CC3299', '#2F4F2F', '#8F8FBD', '#DB70DB', '#D8D8BF', '#4A766E', '#E9C2A6', '#8FBC8F', '#99CC32', '#4F4F2F', 
					'#32CD32', '#BC8F8F',	
				]
			}
		},
		
		onLoad(event){
			uni.showLoading({
				title: '加载中',
				mask: true
			});
			setTimeout(()=>{
				uni.hideLoading()
			},1000)
			
			var _self = this;
			_self.$uniApi.checkPhone("");
			var ss = uni.getStorageSync('biaoqian');
			//console.log(JSON.stringify(ss));	
			var aa = ss.split(",");  
			this.resou = aa;
			
		}, 
		methods: {
			
			search: function(e) {
				if(e.value==undefined){
					var json = e;
				}else{
					var json = e.value;
				}
				if (json == '') {
					uni.showToast({
						title: '请输入内容',
						mask: true,
						icon: 'success',
						duration: 1500
					});
				} else {
					uni.navigateTo({
						url: '/pages/index/scout?keyword=' + json
					})
				}
			},
		}
	}
</script>

<style>
	.tag-yuan {
		height: 10upx;
		width: 30upx;
		background-color: #000000;
		border-radius: 100upx;
		position: absolute;
		top: 20upx;
		left: 20upx;
	}
	
	/* 标签样式 */
	.tag-li {
		background-color: #FFFFFF;
		width: 30%;
		flex-shrink: 0;
		border-radius: 10upx;
		height: 120upx;
		margin: 8upx;
		text-align: center;
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		justify-content: center;
		font-size: 24upx;
		position: relative;
	}
	
	.tag-view {
		display: flex;
		flex-flow: wrap;
		width: 100%;
	}
	
	/* 列表没有数据 */
	.no-list-data {
		text-align: center;
		margin: 30rpx 0px;
		color: #ADADAD;
		font-size: 20upx;
	}
	
	.tag-w {
		height: 60upx;
		line-height: 60upx;
		border-radius: 10upx;
		border: 1px #ececec solid;
		background-color: #ececec;
		padding: 0upx 40upx;
		font-size: 30upx;
		color: #999;
		margin: 20upx;
	}
	
	.tag-all {
		margin: 48upx;
		display: flex;
		flex-wrap: wrap;
		justify-content: flex-start;
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
	
		.tag-li {
			background: #202020
		}
	
	}
</style>
