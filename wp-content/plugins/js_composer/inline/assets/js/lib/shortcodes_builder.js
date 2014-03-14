/* =========================================================
 * lib/shortcodes_builder.js v0.5.0
 * =========================================================
 * Copyright 2014 Wpbakery
 *
 * Visual composer shortcode logic backend.
 *
 * ========================================================= */
(function($) {
  if(_.isUndefined(window.vc)) window.vc = {};
  vc.ShortcodesBuilder = {
    _ajax: false,
    models: [],
    message: false,
    create: function(attributes) {
      this.models.push(vc.shortcodes.create(attributes));
      return this;
    },
    render: function(callback) {
      var shortcodes;
      shortcodes = _.map(this.models, function(model){
        var string = this.toString(model);
        return {id: model.get('id'), string: string, tag: model.get('shortcode')};
      }, this);
      vc.setDataChanged();
      this.build(shortcodes, callback);
    },
    build: function(shortcodes, callback) {
      this.ajax({action: 'vc_load_shortcode', shortcodes: shortcodes}).done(function(html){
        $(html).each(this._renderBlockCallback);
        if(_.isFunction(callback)) callback(html);
        vc.frame.setSortable();
        vc.activity = false;
        this.checkNoContent();
        vc.frame_window.vc_iframe.loadScripts();
        this.last() && vc.frame.scrollTo(this.first());
        this.models = [];
        this.showResultMessage();
      });
    },
    buildFromContent: function() {
      _.each(vc.post_shortcodes, function(shortcode){
        var $block = vc.$page.find('[data-model-id=' + shortcode.id + ']'),
          $parent = $block.parents('[data-model-id]'),
          params = _.isObject(shortcode.attrs) ? shortcode.attrs : {};
        var model = vc.shortcodes.create({
          id: shortcode.id,
          shortcode: shortcode.tag,
          params: params,
          parent_id: $parent.hasClass('vc-element') ? $parent.data('modelId') : false,
          from_content: true
        });
        $block.attr('data-model-id', model.get('id'));
        this._renderBlockCallback.call($block.get(0));
      }, this);
      vc.frame.setSortable();
      this.checkNoContent();
      vc.frame_window.vc_iframe.reload();
    },
    buildFromTemplate: function(html, data) {
      var $html = $(html);
      vc.setDataChanged();
      vc.app.placeElement($html);
      _.each(data, function(shortcode){
        var $block = vc.$page.find('[data-model-id=' + shortcode.id + ']'),
          $parent = $block.parents('[data-model-id]'),
          params = _.isObject(shortcode.attrs) ? shortcode.attrs : {},
          model = vc.shortcodes.create({
            id: shortcode.id,
            shortcode: shortcode.tag,
            params: params,
            parent_id: $parent.hasClass('vc-element') ? $parent.data('modelId') : false,
            default_content: true
          });
        this._renderBlockCallback.call($block.get(0));
      }, this);
      vc.frame.setSortable();
      this.checkNoContent();
      vc.frame_window.vc_iframe.loadScripts();
    },
    _renderBlockCallback: function() {
      var $this = $(this), $html, model;
      if($this.data('type')==='files') {
        vc.frame_window.vc_iframe.addScripts($this.find('script[src],link'));
      } else {
        model = vc.shortcodes.get($this.data('modelId'));
        $html = $this.is('[data-type=element]') ? $($this.html()) : $this;
        model && model.get('shortcode') && vc.ShortcodesBuilder.renderShortcode($html, model);
      }
      vc.setFrameSize();
    },
    renderShortcode: function($html, model) {
      var view_name = this.getView(model);
      !model.get('from_content') && this.placeContainer($html, model);
      model.view = new view_name({model: model, el: $html}).render();
      this.notifyParent(model.get('parent_id'));
      model.view.rendered();
    },
    getView: function(model) {
      var view = model.setting('is_container') || model.setting('as_parent') ? InlineShortcodeViewContainer : InlineShortcodeView;
      if(_.isObject(window['InlineShortcodeView' + '_' + model.get('shortcode')])) {
        view = window['InlineShortcodeView' + '_' + model.get('shortcode')];
      } /*
      else if(_.isString(vc.getMapped(model.get('shortcode')).js_view) && vc.getMapped(model.get('shortcode')).js_view.length && window[vc.getMapped(model.get('shortcode')).js_view]) {
        view = window[vc.getMapped(model.get('shortcode')).js_view];
      }
      */
      return view;
    },
    update: function(model) {
      var shortcode = this.toString(model);
      vc.setDataChanged();
      this.ajax({action: 'vc_load_shortcode', shortcodes: [{id: model.get('id'), string: shortcode, tag: model.get('shortcode')}]})
        .done(function(html){
          var old_view = model.view,
            $html = $(html);
          $html.each(this._renderBlockCallback);
          model.view.$el.insertAfter(old_view.$el);
          if(vc.shortcodes.where({parent_id: model.get('id')}).length) {
            old_view.content().find('> *').appendTo(model.view.content());
          }
          old_view.remove();
          vc.frame_window.vc_iframe.loadScripts();
          model.view.changed();
          vc.frame.setSortable();
          model.view.updated();
        });
    },
    ajax: function(data, url) {
      return this._ajax = $.ajax({
        url: url || vc.admin_ajax,
        type: 'POST',
        dataType: 'html',
        data: _.extend({post_id: vc.post_id, vc_inline: true}, data),
        context: this
      });
    },
    lastID: function() {
      return this.models.length ? _.last(this.models).get('id') : '';
    },
    last: function() {
      return this.models.length ? _.last(this.models) : false;
    },
    firstID: function() {
      return this.models.length ? _.first(this.models).get('id') : '';
    },
    first: function() {
      return this.models.length ? _.first(this.models) : false;
    },
    notifyParent: function(parent_id) {
      var parent = vc.shortcodes.get(parent_id);
      parent && parent.view && parent.view.changed();
    },
    remove: function() {
    },
    _getContainer: function(model) {
      var container, parent_model,
        parent_id = model.get('parent_id');
      if(parent_id !== false) {
        parent_model = vc.shortcodes.get(parent_id);
        if(_.isUndefined(parent_model)) return vc.app;
        // parent_model.view === false && this.addShortcode(parent_model);
        container = parent_model.view;
      } else {
        container = vc.app;
      }
      return container;
    },
    placeContainer: function($html, model) {
      var container = this._getContainer(model);
      container && container.placeElement($html, vc.activity);
      return container;
    },
    toString: function(model, type) {
      var params = model.get('params'),
        content = _.isString(params.content) ? params.content : '';
      return wp.shortcode.string({
        tag: model.get('shortcode'),
        attrs: _.omit(params, 'content'),
        content: content,
        type:_.isString(type) ? type : ''
      });
    },
    modelsToString: function(models) {
      var string = '';
      _.each(models, function(model) {
        var tag = model.get('shortcode'),
          params = model.get('params'),
          content = _.isString(params.content) ? params.content : '';
        content += this.modelsToString(vc.shortcodes.where({parent_id: model.get('id')}));
        string += wp.shortcode.string({
          tag: tag,
          attrs: _.omit(params, 'content'),
          content: content,
          type: content == '' && !vc.getMapped(tag).is_container ? 'single' : ''
        });
      }, this);
      return string;
    },
    getContent: function() {
      vc.shortcodes.sort();
      return this.modelsToString(vc.shortcodes.where({parent_id: false}));
    },
    checkNoContent: function() {
      vc.frame.noContent(!vc.shortcodes.length ? true : false);
    },
    save: function(status) {
      var string = this.getContent(),
        data = {
          action: $('#hiddenaction').val(),
          originalaction: $('#originalaction').val(),
          _wpnonce: $('#_wpnonce').val(),
          user_ID: $('#user-id').val(),
          content: string,
          post_ID: vc.post_id,
          post_custom_css: vc.$custom_css.val()
        };
      if(status) {
        data.post_status = status;
        $('.vc_button_save_draft').hide(100) && $('#vc-button-update').text(window.i18nLocale.update_all);
      }
      if(vc.update_title) data.post_title = vc.title;
      this.ajax(data, 'post.php')
        .done(function(){
          $(window).unbind('beforeunload.vcSave');
          vc.showMessage('Successfully updated!');
        });
    },
    /**
     * Parse shortcode string into objects.
     * @param data
     * @param content
     * @param parent
     * @return {*}
     */
    parse: function (data, content, parent) {
      var tags = _.keys(vc.map).join('|'),
        reg = window.wp.shortcode.regexp(tags),
        matches = content.trim().match(reg);
      if (_.isNull(matches)) return data;
      _.each(matches, function (raw) {
        var sub_matches = raw.match(this.regexp(tags)),
          sub_content = sub_matches[5],
          sub_regexp = new RegExp('^[\\s]*\\[\\[?(' + _.keys(vc.map).join('|') + ')(?![\\w-])'),
          atts_raw = window.wp.shortcode.attrs(sub_matches[3]),
          atts = {},
          shortcode,
          id = vc_guid(),
          map_settings;
        _.each(atts_raw.named, function (value, key) {
          atts[key] = this.unescapeParam(value);
        }, this);
        shortcode = {
          id: id,
          shortcode:sub_matches[2],
          params:_.extend({}, atts),
          parent_id:(_.isObject(parent) ? parent.id : false)
        };
        map_settings = vc.getMapped(shortcode.shortcode);
        data[id] = shortcode;
        if (id == shortcode.root_id) {
          data[id].html = raw;
        }
        if (_.isString(sub_content) && sub_content.match(sub_regexp) &&
          (
            (map_settings.is_container && _.isBoolean(map_settings.is_container) && map_settings.is_container === true) ||
              (!_.isUndefined(map_settings.as_parent) && map_settings.as_parent !== false)
            )) {
          data = this.parseContent(data, sub_content, data[id]);
        } else if (_.isString(sub_content) && sub_content.length && sub_matches[2]==='vc_row') {
          data = this.parseContent(data, '[vc_column width="1/1"][vc_column_text]' + sub_content + '[/vc_column_text][/vc_column]', data[id]);
        } else if (_.isString(sub_content) && sub_content.length && sub_matches[2]==='vc_column') {
          data = this.parseContent(data, '[vc_column_text]' + sub_content + '[/vc_column_text]', data[id]);
        } else if (_.isString(sub_content)) {
          data[id].params.content = sub_content; // sub_content.match(/\n/) && !_.isUndefined(window.switchEditors) ? window.switchEditors.wpautop(sub_content) : sub_content;
        }
      }, this);
      return data;
    },
    regexp:_.memoize(function (tags) {
      return new RegExp('\\[(\\[?)(' + tags + ')(?![\\w-])([^\\]\\/]*(?:\\/(?!\\])[^\\]\\/]*)*?)(?:(\\/)\\]|\\](?:([^\\[]*(?:\\[(?!\\/\\2\\])[^\\[]*)*)(\\[\\/\\2\\]))?)(\\]?)');

    }),
    /**
     * Unescape double quotes in params valus.
     * @param value
     * @return {*}
     */
    unescapeParam:function (value) {
      return value.replace(/(\`{2})/g, '"');
    },
    setResultMessage: function(string) {
      this.message = string;
    },
    showResultMessage: function() {
      if(this.message !== false) vc.showMessage(this.message);
      this.message = false;
    }
  };
})(window.jQuery);