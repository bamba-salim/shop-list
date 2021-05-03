var JUtil = (function(){
    //new layout for logger
    const CompactBasicLayout = function(){}; //for logger
    //check if exist Log4js
    if(typeof Log4js !== "undefined"){
        //setup layout
        CompactBasicLayout.prototype = Log4js.extend(new Log4js.BasicLayout(), {
            format: function(loggingEvent) {
                return "[" + loggingEvent.level.toString().charAt(0) + "] " + loggingEvent.categoryName + ": " + loggingEvent.message + this.LINE_SEP;
            }
        });
    }

    return {
        toSearchUrlParams: function(obj){
            var str = "";
            var paramVal;

            for(var key in obj){
                if(obj.hasOwnProperty(key)){
                    paramVal = obj[key].replace(" ", "+"); //space to "+"
                    str+=key+"="+paramVal+"&";
                }
            }
            return str;
        },
        toUrlParames: function(obj){
            var str = "";
            for(var key in obj){
                if(obj.hasOwnProperty(key)){
                    str+=key+"="+encodeURI(obj[key])+"&";
                }
            }
            return str;
        },
        addParamToUrl : function(url, param, value){
            var hash       = {};
            var parser     = document.createElement('a');
            parser.href    = url;

            var parameters = parser.search.split(/\?|&/);
            for(var i=0; i < parameters.length; i++) {
                if(!parameters[i])
                    continue;
                var ary      = parameters[i].split('=');
                hash[ary[0]] = ary[1];
            }
            hash[param] = value;

            var list = [];
            Object.keys(hash).forEach(function (key) {
                list.push(key + '=' + hash[key]);
            });

            parser.search = '?' + list.join('&');
            return parser.href;
        },
        downloadFile: function(action, parameters){
            var submitForm  = $("<form action=\"\" method=\"post\" class='hidden'>").prop("action", action);
            //adding parameters
            for(var key in parameters){
                if(parameters.hasOwnProperty(key)){
                    submitForm.append(addParameter(key, parameters[key]));
                }
            }
            submitForm.appendTo("body");
            //submit form
            submitForm.submit();

            function addParameter(name, value){
                return $("<input type=\"hidden\" name=\"\"/>").prop("name", name).val(value);
            }
        },
        groupBy : function(list, pathToPropertyToGroup, customizer){ //return obj:  {groupKey : {'items': []}}
            var groups = {}, oneGroup, groupKey;
            _.forEach(list, function (item, index) {
                groupKey = _.result(item, pathToPropertyToGroup, -1);
                oneGroup = groups[groupKey];
                if(_.isUndefined(oneGroup)){
                    oneGroup = {items:[]};
                    groups[groupKey] = oneGroup;
                }
                oneGroup.items.push(item);
                //trigger customizer
                (customizer || _.noop)(oneGroup, item, groupKey);
            });
            return groups;
        },
        handleJsonResult: function(httpResponse){
            const data = httpResponse.data;
            if(httpResponse.status === 200){
                if(data.error || typeof data.results === "undefined"){
                    alert(data.error);
                    console.error(data);
                    throw new Error(data.error);
                }else{
                    return data.results;
                }
            }else{
                alert("Server error: code " +httpResponse.status);
                console.error(httpResponse);
            }
        },
        handleRedirectResult: function(httpResponse){
            if(httpResponse.status === 800){ //custom response code
                const redirectUrl = httpResponse.data; //= redirect url
                window.location.replace(redirectUrl);
            }else{
                return httpResponse;
            }
        },
        handleRedirectWithHistoryResult: function(httpResponse){
            if(httpResponse.status === 800){ //custom response code
                const redirectUrl = httpResponse.data; //= redirect url
                window.location.href= redirectUrl;
            }else{
                alert("Server error: code " +httpResponse.status);
                console.error(httpResponse);
            }
        },
        handleRedirectNewTab: function(httpResponse){
            if(httpResponse.status === 800){ //custom response code
                const redirectUrl = httpResponse.data; //= redirect url
                window.open(redirectUrl, '_blank');
            }else{
                alert("Server error: code " +httpResponse.status);
                console.error(httpResponse);
            }
        },
        handleHttpResult: function(httpResponse){
            if(httpResponse.status === 200){
                return httpResponse;
            }else{
                console.error(httpResponse);
                alert("Server error: code " +httpResponse.status);
                throw new Error("Error " + httpResponse.status);
            }
        },
        noopPromise : function(resolveData){
            return new Promise(function(resolve, reject){
                setTimeout(function(){
                    resolve(resolveData);
                }, 20); //ms
            });
        },
        stringFormat : function(format) {
            var args = Array.prototype.slice.call(arguments, 1);
            return format.replace(/{(\d+)}/g, function(match, number) {
                return typeof args[number] != 'undefined'
                    ? args[number]
                    : match
                    ;
            });
        },
        debounceFn : function(func, wait, immediate){
            var timeout;
            return function() {
                var context = this, args = arguments;
                var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        },
        getLogger: function(name, level){
            var consoleLog;
            if(Log4js.loggers.hasOwnProperty(name)){ //get exist logger
                consoleLog = Log4js.getLogger(name);
            }else{ //create new logger
                consoleLog = Log4js.getLogger(name);
                if(level) consoleLog.setLevel(level); //default level
                //setup appender
                const appender = new Log4js.BrowserConsoleAppender();
                appender.setLayout(new CompactBasicLayout()); //message format
                consoleLog.addAppender(appender);
            }

            return consoleLog;
        },
        setLoggerLevel: function(name, level){
            const logger = Log4js.getLogger(name);
            if(logger) {
                logger.setLevel(level);
            }else{
                console.log("not found looger: " + name);
            }
        }
    };
})();