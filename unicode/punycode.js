var PunyCode=(function(){var F=36,B=1,G=26,C=38,$=700,K=72,I=128,O=45,H=Math.pow(2,31)-1;function J($){return $<128}function D($){return $==O}function L($){return($-48<10?$-22:$-65<26?$-65:$-97<26?$-97:F)}function N($,_){return($+22+75*($<26)-((_!=0)<<5))}function _($){return($-65<26)}function P(_,$){_-=(_-97<26)<<5;return _+((!$&&(_-65<26))<<5)}function A(_,A,E){var D;_=Math.floor(E?_/$:_/2);_+=Math.floor(_/A);for(D=0;_>Math.floor(((F-B)*G)/2);D+=F)_=Math.floor(_/(F-B));return Math.floor(D+(F-B+1)*_/(_+C))}function M(P,S){var C=I,_=0,U=0,T=K;for(var E=0;E<P.length;++E)if(J(P[E]))S.push(P[E]);var M=U,$=U;if($>0)S.push(O);while(M<P.length){var D=H;for(E=0;E<P.length;++E)if(P[E]>=C&&P[E]<D)D=P[E];if(D-C>Math.floor((H-_)/(M+1)))return false;_+=(D-C)*(M+1);C=D;for(E=0;E<P.length;++E){if(P[E]<C)if(++_==0)return false;if(P[E]==C){var R=_;for(var L=F;;L+=F){var Q=L<=T?B:L>=T+G?G:L-T;if(R<Q)break;S.push(N(Q+(R-Q)%(F-Q),0));R=Math.floor((R-Q)/(F-Q))}S.push(N(R,false));T=A(_,M+1,M==$);_=0;++M}}++_;++C}return true}function E(R,T){var C=I,V=0,U=K,_=0;for(var E=0;E<R.length;++E)if(D(R[E]))_=E;for(E=0;E<_;++E){if(!J(R[E]))return false;T.push(R[E])}var O=0,$=_>0?_+1:0;for(;$<R.length;++V){var N=O,Q=1;for(var M=F;;M+=F){if($>=R.length)return false;var P=L(R[$++]);if(P>=F)return false;if(P>Math.floor((H-O)/Q))return false;O+=P*Q;var S=(M<=U?B:M>=U+G?G:M-U);if(P<S)break;if(Q>Math.floor(H/(F-S)))return false;Q*=(F-S)}U=A(O-N,V+1,N==0);if(O/(V+1)>H-C)return false;C+=Math.floor(O/(V+1));O%=(V+1);T.splice(O,0,C);++O}return true}return{encode:M,decode:E}})()