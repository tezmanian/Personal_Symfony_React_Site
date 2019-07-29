import React from "react";
import { Link } from "react-router-dom";
import ReactMarkdown from "react-markdown";
import emoji from "emoji-dictionary";
const LinkRenderer = ({ ...children }) => <Link {...children} />;

const emojiSupport = text =>
  text.value.replace(/:\w+:/gi, name => emoji.getUnicode(name));

export function MarkDown(markdown) {
  return (
    <ReactMarkdown
      source={markdown.content}
      renderers={{
        Link: LinkRenderer,
        text: emojiSupport
      }}
      escapeHtml={false}
    />
  );
}

export const authenticationHelper = {
  MarkDown
};
