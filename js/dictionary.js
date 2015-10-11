/*
Constructor:
	Dictionary()
Attributes:
	CompareMode:0——binary 1——text
	Count: count
	ThrowException: throw exception or not
Methods:
	Item(key): get value by key
	Keys(): get key array
	Values(): get value array
	Add(key,value): add key-value into dic
	BatchAdd(keys,values): try to add, if sucess return true, otherwise return false
	Clear(): clear all
	ContainsKey(key)
	ContainsValue(value)
	Remove(key): delete key-value
	TryGetValue(key,defaultValue): try to get value, if fail, return default
	ToString()
*/
function Dictionary()
{
	var me=this;			
	
	this.CompareMode=1;
	
	this.Count=0;			
	
	this.arrKeys=new Array();	
	
	this.arrValues=new Array();	
	
	this.ThrowException=true;	
	
	this.Item=function(key)
	{
		var idx=GetElementIndexInArray(me.arrKeys,key);
		if(idx!=-1)
		{
			return me.arrValues[idx];
		}
		else
		{
			if(me.ThrowException)
				throw "key does not exist";
		}
	}
	
	this.Keys=function()
	{
		return me.arrKeys;
	}
	
	this.Values=function()
	{
		return me.arrValues;
	}
	
	this.Add=function(key,value)
	{
		if(CheckKey(key))
		{
			me.arrKeys[me.Count]=key;
			me.arrValues[me.Count]=value;
			me.Count++;
		}
		else
		{
			if(me.ThrowException)
				throw "Invalid key or key exists";
		}
	}
	
	this.BatchAdd=function(keys,values)
	{
		var bSuccessed=false;
		if(keys!=null && keys!=undefined && values!=null && values!=undefined)
		{
			if(keys.length==values.length && keys.length>0)
			{
				var allKeys=me.arrKeys.concat(keys);
				if(!IsArrayElementRepeat(allKeys))
				{
					me.arrKeys=allKeys;
					me.arrValues=me.arrValues.concat(values);
					me.Count=me.arrKeys.length;
					bSuccessed=true;
				}
			}
		}
		return bSuccessed;
	}
	
	this.Clear=function()
	{
		if(me.Count!=0)
		{
			me.arrKeys.splice(0,me.Count);
			me.arrValues.splice(0,me.Count);
			me.Count=0;
		}
	}
	
	this.ContainsKey=function(key)
	{
		return GetElementIndexInArray(me.arrKeys,key)!=-1;
	}
	
	this.ContainsValue=function(value)
	{
		return GetElementIndexInArray(me.arrValues,value)!=-1;
	}
	
	this.Remove=function(key)
	{
		var idx=GetElementIndexInArray(me.arrKeys,key);
		if(idx!=-1)
		{
			me.arrKeys.splice(idx,1);
			me.arrValues.splice(idx,1);
			me.Count--;
			return true;
		}
		else
			return false;
	}
	
	this.TryGetValue=function(key,defaultValue)
	{
		var idx=GetElementIndexInArray(me.arrKeys,key);
		if(idx!=-1)
		{
			return me.arrValues[idx];
		}
		else
			return defaultValue;
	}
	
	this.ToString=function()
	{
		if(me.Count==0)
			return "";
		else
			return me.arrKeys.toString() + ";" + me.arrValues.toString();
	}
	
	function CheckKey(key)
	{
		if(key==null || key==undefined || key=="" || key==NaN)
			return false;
		return !me.ContainsKey(key);
	}
	
	function GetElementIndexInArray(arr,e)
	{
		var idx=-1;
		var i;
		if(!(arr==null || arr==undefined || typeof(arr)!="object"))
		{
			try
			{
				for(i=0;i<arr.length;i++)
				{
					var bEqual;
					if(me.CompareMode==0)
						bEqual=(arr[i]===e);
					else
						bEqual=(arr[i]==e);
					if(bEqual)
					{
						idx=i;
						break;
					}
				}
			}
			catch(err)
			{
			}
		}
		return idx;
	}
	
	function IsArrayElementRepeat(arr)
	{
		var bRepeat=false;
		if(arr!=null && arr!=undefined && typeof(arr)=="object")
		{
			var i;
			for(i=0;i<arr.length-1;i++)
			{
				var bEqual;
				if(me.CompareMode==0)
					bEqual=(arr[i]===arr[i+1]);
				else
					bEqual=(arr[i]==arr[i+1]);
				if(bEqual)
				{
					bRepeat=true;
					break;
				}
			}
		}
		return bRepeat;
	}
}
