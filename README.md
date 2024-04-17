# Freeze

## Description
Freeze is a simple plugin that allows you to freeze players, preventing them from moving, using commands, interacting with blocks, and more. This plugin is very useful for when you want to freeze a player to prevent them from doing something.

If you have any problems please create an issue I will try to answer them as soon as possible. And feel free to star the project

Finally, if you are looking for private plugins at a good price, I can make some on my discord: yakuuuuuuuuuuuuuuu_

### Config

```yaml
player-not-found: "§e{player} §cnot found!"
listeners:
  command:
    on: true
    messageOn: true
    message: "You can't use commands while frozen!"
  move:
    on: true
    messageOn: true
    message: "You can't move while frozen!"
  drop:
    on: true
    messageOn: true
    message: "You can't drop items while frozen!"
  interact:
    on: true
    messageOn: true
    message: "You can't interact with blocks while frozen!"
  pickup:
    on: true
    messageOn: true
    message: "You can't pickup items while frozen!"
  damage:
    on: true
    messageOn: true
    message: "You can't take damage while frozen!"
  break:
    on: true
    messageOn: true
    message: "You can't break blocks while frozen!"
  place:
    on: true
    messageOn: true
    message: "You can't place blocks while frozen!"
```
## Features
`Cancel Command` | ✔ |  
`Cancel Move` | ✔ |  
`Cancel Drop` | ✔ |  
`Cancel Interact` | ✔ |  
`Cancel Pickup Item` | ✔ |  
`Cancel Damage` | ✔ |  
`Cancel BlockBreak` | ✔ |  
`Cancel BlockPlace` | ✔ |  
