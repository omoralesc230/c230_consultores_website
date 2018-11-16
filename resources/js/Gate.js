export default class Gate{
  constructor(user){
    this.user = user;
  }

  isAdmin(){
    return this.user.type === 'admin';
  }

  isContentAdmin(){
    return this.user.type === 'content admin';
  }

  isTalentAdmin(){
    return this.user.type === 'talent admin';
  }

  isUser(){
    return this.user.type === 'user';
  }
}
