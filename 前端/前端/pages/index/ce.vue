<template>
	<view class="wrap">
		<!--  -->
		<view class="fload" :class="isFload ? 'hide' : 'show'">
				散文是一个汉语词汇，拼音是sǎn wén。
一指文采焕发；二指犹行文；三指文体名。散文是一种抒发作者真情实感、
散文是一个汉语词汇，拼音是sǎn wén。一指文采焕发；
二指犹行文；三指文体名。散文是一种抒发作者真情实感、
写作方式灵活的记叙类文学体裁。“散文”一词大概出现在北宋太平...
		</view>
		
		<!-- 此处用了iconfont图标，自行处理或换成自己的图标-->
		<text v-if="isFload"  class="iconfont upArrow switch" @click="fload">12</text>
		<text v-if="!isFload" class="iconfont downArrow switch" @click="fload">2</text>
	</view>
	
</template>
 
<script>
	export default{
	      data(){
		   return{
			isFload: true 
		   }
		},
		methods:{
		    fload(){
                          //改变isFload的状态
			  this.isFload = !this.isFload;
		    }
		}
	}
</script>
 
<style>
	.wrap{
		width:700upx;
		display: flex;
		font-size:26upx;
		justify-content: space-between;
		margin: 0 auto;
	}
	.fload{
		width:600upx;
		height: auto;
		display: -webkit-box;
		word-break: break-all;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 3;
		overflow: hidden;
		text-overflow: ellipsis;
		margin-right: 40upx;
		background-color:#F5F5F5;
	}
	.hide{
		display: -webkit-box;
	}
	.show{
		display: block;
	}
	
 
</style>
 