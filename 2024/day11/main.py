f = open('2.in', 'r')

def update_stone(stone):
    if stone == 0:
        return [1]
    
    if len(str(stone)) % 2 == 0:
        stone = str(stone)
        return [int(stone[:len(stone)//2]), int(stone[len(stone)//2:])]
    
    return [stone * 2024]

def update(arrangement):
    new_arrangement = {}
    for stone in arrangement:
        new_stones = update_stone(stone)
        for new_stone in new_stones:
            if new_stone not in new_arrangement:
                new_arrangement[new_stone] = 0
            new_arrangement[new_stone] += arrangement[stone]
    return new_arrangement

if __name__ == '__main__':
    v = [int(x) for x in f.readline().split()]
    d = {}

    for val in v:
        if val not in d:
            d[val] = 1
        else:
            d[val] += 1
        

    for i in range(0, 75):
        d = update(d)
        print(f'Blink no. {i} done!')
        
    print(sum(d.values()))